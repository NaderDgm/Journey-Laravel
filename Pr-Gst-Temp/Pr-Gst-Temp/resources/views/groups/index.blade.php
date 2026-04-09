@extends('layouts.app')

@section('title', 'Groupes')

@section('content')
    <div class="flex flex-col gap-6">
        <header class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Groupes</h1>
                <p class="text-sm text-slate-600">Gérez les groupes de formation.</p>
            </div>

            <a href="{{ route('groups.create') }}" class="inline-flex items-center gap-2 rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">
                Nouveau groupe
            </a>
        </header>

        @if ($groups->isEmpty())
            <div class="rounded-lg border border-dashed border-slate-300 bg-white p-10 text-center text-slate-600">
                Aucun groupe n'a été créé pour le moment.
            </div>
        @else
            <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Code</th>
                            <th class="px-4 py-3">Filière</th>
                            <th class="px-4 py-3">Année</th>
                            <th class="px-4 py-3">Formateurs</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($groups as $group)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $group->code }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $group->filiere->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $group->year }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $group->teachers->pluck('full_name')->join(', ') }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('groups.edit', $group) }}" class="rounded-md px-3 py-1 text-xs font-medium text-sky-700 ring-1 ring-sky-200 hover:bg-sky-50">Modifier</a>
                                        <form action="{{ route('groups.destroy', $group) }}" method="POST" onsubmit="return confirm('Supprimer ce groupe ?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md bg-rose-600 px-3 py-1 text-xs font-medium text-white hover:bg-rose-700">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $groups->links() }}
            </div>
        @endif
    </div>
@endsection
