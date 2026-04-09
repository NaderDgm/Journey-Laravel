<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Group;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ScheduleController extends Controller
{
    private array $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

    private array $slots = [
        '08:30' => '11:00',
        '11:00' => '13:30',
        '13:30' => '16:00',
        '16:00' => '18:30',
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(): View
    {
        $user = auth()->user();
        $view = request()->query('view', 'table');
        $filiereId = request()->query('filiere_id');
        $groupId = request()->query('group_id');
        $teacherId = request()->query('teacher_id');

        if ($user->isStudent() && $user->group_id) {
            $groupId = $user->group_id;
        }

        if ($user->isTeacher() && $user->teacher_id) {
            $teacherId = $user->teacher_id;
        }

        $filieres = Filiere::orderBy('name')->get();
        $groups = Group::with('filiere')->orderBy('code')->get();
        $teachers = Teacher::orderBy('last_name')->orderBy('first_name')->get();

        $query = $this->buildFilteredQuery($filiereId, $groupId, $teacherId);

        if ($view === 'grid') {
            $schedules = $query->get();
        } else {
            $schedules = $query->paginate(15)->withQueryString();
        }

        return view('schedules.index', [
            'schedules' => $schedules,
            'view' => $view,
            'filiereId' => $filiereId,
            'groupId' => $groupId,
            'teacherId' => $teacherId,
            'filieres' => $filieres,
            'groups' => $groups,
            'teachers' => $teachers,
            'days' => $this->days,
        ]);
    }

    public function create(): View
    {
        return view('schedules.create', [
            'filieres' => Filiere::orderBy('name')->get(),
            'groups' => Group::with('filiere')->orderBy('code')->get(),
            'rooms' => Room::orderBy('name')->get(),
            'teachers' => Teacher::orderBy('last_name')->orderBy('first_name')->get(),
            'days' => $this->days,
            'slots' => $this->slots,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'group_id' => ['required', 'exists:groups,id'],
            'title' => ['required', 'string', 'max:255'],
            'day' => ['required', 'in:' . implode(',', $this->days)],
            'slot' => ['required', 'in:' . implode(',', array_keys($this->slots))],
            'room_id' => ['nullable', 'exists:rooms,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'room' => ['nullable', 'string', 'max:255'],
            'teacher' => ['nullable', 'string', 'max:255'],
        ]);

        $start = $validated['slot'];
        $end = $this->slots[$start];

        $group = Group::findOrFail($validated['group_id']);

        $this->ensureNoConflicts($validated['group_id'], $validated['teacher_id'] ?? null, $validated['room_id'] ?? null, $validated['day'], $start);

        Schedule::create([
            'group_id' => $validated['group_id'],
            'filiere_id' => $group->filiere_id,
            'title' => $validated['title'],
            'day' => $validated['day'],
            'start_time' => $start,
            'end_time' => $end,
            'room_id' => $validated['room_id'] ?? null,
            'teacher_id' => $validated['teacher_id'] ?? null,
            'room' => $validated['room'] ?? null,
            'teacher' => $validated['teacher'] ?? null,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Créneau ajouté.');
    }

    public function edit(Schedule $schedule): View
    {
        return view('schedules.edit', [
            'schedule' => $schedule,
            'filieres' => Filiere::orderBy('name')->get(),
            'groups' => Group::with('filiere')->orderBy('code')->get(),
            'rooms' => Room::orderBy('name')->get(),
            'teachers' => Teacher::orderBy('last_name')->orderBy('first_name')->get(),
            'days' => $this->days,
            'slots' => $this->slots,
        ]);
    }

    public function update(Request $request, Schedule $schedule): RedirectResponse
    {
        $validated = $request->validate([
            'group_id' => ['required', 'exists:groups,id'],
            'title' => ['required', 'string', 'max:255'],
            'day' => ['required', 'in:' . implode(',', $this->days)],
            'slot' => ['required', 'in:' . implode(',', array_keys($this->slots))],
            'room_id' => ['nullable', 'exists:rooms,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'room' => ['nullable', 'string', 'max:255'],
            'teacher' => ['nullable', 'string', 'max:255'],
        ]);

        $start = $validated['slot'];
        $end = $this->slots[$start];

        $group = Group::findOrFail($validated['group_id']);

        $this->ensureNoConflicts($validated['group_id'], $validated['teacher_id'] ?? null, $validated['room_id'] ?? null, $validated['day'], $start, $schedule->id);

        $schedule->update([
            'group_id' => $validated['group_id'],
            'filiere_id' => $group->filiere_id,
            'title' => $validated['title'],
            'day' => $validated['day'],
            'start_time' => $start,
            'end_time' => $end,
            'room_id' => $validated['room_id'] ?? null,
            'teacher_id' => $validated['teacher_id'] ?? null,
            'room' => $validated['room'] ?? null,
            'teacher' => $validated['teacher'] ?? null,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Créneau mis à jour.');
    }

    public function destroy(Schedule $schedule): RedirectResponse
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Créneau supprimé.');
    }

    private function buildFilteredQuery(?int $filiereId, ?int $groupId, ?int $teacherId)
    {
        $query = Schedule::with(['group.filiere', 'room', 'teacher'])
            ->orderBy('day')
            ->orderBy('start_time');

        if ($filiereId) {
            $query->whereHas('group', fn ($q) => $q->where('filiere_id', $filiereId));
        }

        if ($groupId) {
            $query->where('group_id', $groupId);
        }

        if ($teacherId) {
            $query->where('teacher_id', $teacherId);
        }

        return $query;
    }

    private function ensureNoConflicts(int $groupId, ?int $teacherId, ?int $roomId, string $day, string $start, int $ignoreId = null): void
    {
        $baseQuery = Schedule::where('day', $day)->where('start_time', $start);

        if ($ignoreId) {
            $baseQuery->where('id', '!=', $ignoreId);
        }

        if ((clone $baseQuery)->where('group_id', $groupId)->exists()) {
            abort(422, 'Ce groupe a déjà un créneau à ce créneau horaire.');
        }

        if ($teacherId && (clone $baseQuery)->where('teacher_id', $teacherId)->exists()) {
            abort(422, 'Ce formateur est déjà occupé à ce créneau horaire.');
        }

        if ($roomId && (clone $baseQuery)->where('room_id', $roomId)->exists()) {
            abort(422, 'Cette salle est déjà occupée à ce créneau horaire.');
        }

        $count = Schedule::where('group_id', $groupId)->where('day', $day)->whereNotNull('start_time');
        if ($ignoreId) {
            $count->where('id', '!=', $ignoreId);
        }

        if ($count->count() >= 4) {
            abort(422, 'Ce groupe a déjà 4 séances planifiées pour ce jour.');
        }
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $user = auth()->user();
        $filiereId = $request->query('filiere_id');
        $groupId = $request->query('group_id');
        $teacherId = $request->query('teacher_id');

        if ($user->isStudent() && $user->group_id) {
            $groupId = $user->group_id;
        }

        if ($user->isTeacher() && $user->teacher_id) {
            $teacherId = $user->teacher_id;
        }

        $schedules = $this->buildFilteredQuery($filiereId, $groupId, $teacherId)->get();

        $schedules->load(['group.filiere', 'room', 'teacher']);

        $filename = 'emploi_du_temps_' . now()->format('Ymd_His') . '.csv';

        return new StreamedResponse(function () use ($schedules) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Filière', 'Intitulé', 'Jour', 'Début', 'Fin', 'Salle', 'Enseignant']);

            foreach ($schedules as $schedule) {
                fputcsv($handle, [
                    $schedule->filiere->name ?? '-',
                    $schedule->title,
                    $schedule->day,
                    substr($schedule->start_time, 0, 5),
                    substr($schedule->end_time, 0, 5),
                    $schedule->room_name ?? '-',
                    $schedule->teacher_name ?? '-',
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function exportPdf(Request $request): Response
    {
        $user = auth()->user();
        $filiereId = $request->query('filiere_id');
        $groupId = $request->query('group_id');
        $teacherId = $request->query('teacher_id');

        if ($user->isStudent() && $user->group_id) {
            $groupId = $user->group_id;
        }

        if ($user->isTeacher() && $user->teacher_id) {
            $teacherId = $user->teacher_id;
        }

        $schedules = $this->buildFilteredQuery($filiereId, $groupId, $teacherId)->get();

        $schedules->load(['group.filiere', 'room', 'teacher']);

        $pdf = Pdf::loadView('schedules.export-pdf', [
            'schedules' => $schedules,
            'days' => $this->days,
            'user' => $user,
            'groupId' => $groupId,
            'teacherId' => $teacherId,
        ]);

        $filename = 'emploi_du_temps_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }
}