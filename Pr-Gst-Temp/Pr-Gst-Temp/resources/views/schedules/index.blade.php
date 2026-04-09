@extends('layouts.app')

@section('title', 'Emploi du temps')

@section('content')
    <div class="flex flex-col gap-6">
        <header class="flex flex-col gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Emploi du temps</h1>
                <p class="text-sm text-slate-600">Vue des séances planifiées (groupes, formateurs, salles).</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('schedules.create') }}" class="inline-flex items-center gap-2 rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">
                        Ajouter un créneau
                    </a>
                @endif

                <a href="{{ route('schedules.index', array_merge(request()->query(), ['view' => 'table'])) }}" class="rounded-md px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 {{ $view === 'table' ? 'bg-slate-100' : '' }}">
                    Vue liste
                </a>
                <a href="{{ route('schedules.index', array_merge(request()->query(), ['view' => 'grid'])) }}" class="rounded-md px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 {{ $view === 'grid' ? 'bg-slate-100' : '' }}">
                    Vue grille
                </a>

                <a href="{{ route('schedules.export.csv', request()->query()) }}" class="rounded-md border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Export CSV
                </a>
                <a href="{{ route('schedules.export.pdf', request()->query()) }}" class="rounded-md border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Export PDF
                </a>
            </div>

            <form method="GET" action="{{ route('schedules.index') }}" class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <div>
                        <label class="mb-1 block text-xs font-semibold text-slate-600" for="filiere_id">Filière</label>
                        <select id="filiere_id" name="filiere_id" class="w-full rounded border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="">Toutes</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ $filiereId == $filiere->id ? 'selected' : '' }}>{{ $filiere->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-semibold text-slate-600" for="group_id">Groupe</label>
                        <select id="group_id" name="group_id" class="w-full rounded border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="">Tous</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ $groupId == $group->id ? 'selected' : '' }}>{{ $group->code }} ({{ $group->filiere->name ?? '' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-semibold text-slate-600" for="teacher_id">Formateur</label>
                        <select id="teacher_id" name="teacher_id" class="w-full rounded border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="">Tous</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $teacherId == $teacher->id ? 'selected' : '' }}>{{ $teacher->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end justify-start">
                        <button type="submit" class="w-full rounded-md bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-900">
                            Filtrer
                        </button>
                    </div>
                </div>
            </form>
        </header>

        @if ($schedules->isEmpty())
            <div class="rounded-lg border border-dashed border-slate-300 bg-white p-10 text-center text-slate-600">
                Aucun créneau n'a été planifié pour le moment.
            </div>
        @else
            @if ($view === 'grid')
                @php
                    $times = $schedules->pluck('start_time')->unique()->sort()->values();
                    $grouped = $schedules->groupBy('day');
                @endphp

                <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3">Heure</th>
                                @foreach ($days as $day)
                                    <th class="px-4 py-3">{{ $day }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($times as $time)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-3 font-medium text-slate-900">{{ \Illuminate\Support\Str::substr($time, 0, 5) }}</td>
                                    @foreach ($days as $day)
                                        @php
                                            $cell = $grouped->get($day)?->where('start_time', $time)->first();
                                        @endphp
                                        <td class="px-4 py-3 align-top">
                                            @if ($cell)
                                                <div class="rounded-lg border border-slate-200 bg-white p-3 shadow-sm">
                                                    <p class="text-sm font-semibold text-slate-900">{{ $cell->title }}</p>
                                                    <p class="text-xs text-slate-600">{{ $cell->filiere->name }}</p>
                                                    <p class="text-xs text-slate-600">Salle: {{ $cell->room_name ?? '-' }}</p>
                                                    <p class="text-xs text-slate-600">Prof: {{ $cell->teacher_name ?? '-' }}</p>
                                                    @if (auth()->check() && auth()->user()->isAdmin())
                                                        <div class="mt-2 flex flex-wrap gap-2">
                                                            <a href="{{ route('schedules.edit', $cell) }}" class="text-xs text-sky-700 hover:underline">Modifier</a>
                                                            <form action="{{ route('schedules.destroy', $cell) }}" method="POST" onsubmit="return confirm('Supprimer ce créneau ?');" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-xs text-rose-700 hover:underline">Supprimer</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3">Filière</th>
                                <th class="px-4 py-3">Intitulé</th>
                                <th class="px-4 py-3">Jour</th>
                                <th class="px-4 py-3">Heure</th>
                                <th class="px-4 py-3">Salle</th>
                                <th class="px-4 py-3">Enseignant</th>
                                <th class="px-4 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($schedules as $schedule)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-3 font-medium text-slate-900">{{ $schedule->filiere->name }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $schedule->title }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $schedule->day }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ \Illuminate\Support\Str::substr($schedule->start_time, 0, 5) }} - {{ \Illuminate\Support\Str::substr($schedule->end_time, 0, 5) }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $schedule->room_name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $schedule->teacher_name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            @if(auth()->check() && auth()->user()->isAdmin())
                                                <a href="{{ route('schedules.edit', $schedule) }}" class="rounded-md px-3 py-1 text-xs font-medium text-sky-700 ring-1 ring-sky-200 hover:bg-sky-50">Modifier</a>
                                                <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Supprimer ce créneau ?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="rounded-md bg-rose-600 px-3 py-1 text-xs font-medium text-white hover:bg-rose-700">Supprimer</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $schedules->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
