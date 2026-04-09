<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(): View
    {
        $groups = Group::with('filiere')->orderBy('code')->paginate(15);

        return view('groups.index', compact('groups'));
    }

    public function create(): View
    {
        return view('groups.create', [
            'filieres' => Filiere::orderBy('name')->get(),
            'teachers' => Teacher::orderBy('last_name')->orderBy('first_name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:groups,code'],
            'filiere_id' => ['required', 'exists:filieres,id'],
            'year' => ['required', 'integer', 'in:1,2'],
            'teacher_ids' => ['nullable', 'array'],
            'teacher_ids.*' => ['integer', 'exists:teachers,id'],
        ]);

        $group = Group::create($validated);

        if (! empty($validated['teacher_ids'])) {
            $group->teachers()->sync($validated['teacher_ids']);
        }

        return redirect()->route('groups.index')->with('success', 'Groupe créé.');
    }

    public function edit(Group $group): View
    {
        return view('groups.edit', [
            'group' => $group,
            'filieres' => Filiere::orderBy('name')->get(),
            'teachers' => Teacher::orderBy('last_name')->orderBy('first_name')->get(),
        ]);
    }

    public function update(Request $request, Group $group): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:groups,code,' . $group->id],
            'filiere_id' => ['required', 'exists:filieres,id'],
            'year' => ['required', 'integer', 'in:1,2'],
            'teacher_ids' => ['nullable', 'array'],
            'teacher_ids.*' => ['integer', 'exists:teachers,id'],
        ]);

        $group->update($validated);
        $group->teachers()->sync($validated['teacher_ids'] ?? []);

        return redirect()->route('groups.index')->with('success', 'Groupe mis à jour.');
    }

    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Groupe supprimé.');
    }
}