@extends('layouts.app')

@section('title', 'Professeurs')

@section('content')
    <div class="flex flex-col gap-6">
        <header class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Professeurs</h1>
                <p class="text-sm text-slate-600">Gérez les professeurs de votre établissement.</p>
            </div>

            <a href="{{ route('teachers.create') }}" class="inline-flex items-center gap-2 rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">
                Nouveau professeur
            </a>
        </header>

        @if ($teachers->isEmpty())
            <div class="rounded-lg border border-dashed border-slate-300 bg-white p-10 text-center text-slate-600">
                Aucun professeur n'a été créé pour le moment.
            </div>
        @else
            <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Nom</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Téléphone</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($teachers as $teacher)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $teacher->full_name }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $teacher->email ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $teacher->phone ?? '-' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('teachers.edit', $teacher) }}" class="rounded-md px-3 py-1 text-xs font-medium text-sky-700 ring-1 ring-sky-200 hover:bg-sky-50">Modifier</a>
                                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Supprimer ce professeur ?');" class="inline">
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
                {{ $teachers->links() }}
            </div>
        @endif
    </div>
@endsection
