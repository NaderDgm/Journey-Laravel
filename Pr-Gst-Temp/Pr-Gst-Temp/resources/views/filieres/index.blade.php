@extends('layouts.app')

@section('title', 'Filières')

@section('content')
    <div class="flex flex-col gap-6">
        <header class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Filières</h1>
                <p class="text-sm text-slate-600">Gérez les filières de votre établissement.</p>
            </div>

            <a href="{{ route('filieres.create') }}" class="inline-flex items-center gap-2 rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">
                Nouvelle filière
            </a>
        </header>

        @if ($filieres->isEmpty())
            <div class="rounded-lg border border-dashed border-slate-300 bg-white p-10 text-center text-slate-600">
                Aucune filière n'a été créée pour le moment.
            </div>
        @else
            <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Nom</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($filieres as $filiere)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $filiere->name }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ \Illuminate\Support\Str::limit($filiere->description, 80, '...') }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('filieres.show', $filiere) }}" class="rounded-md px-3 py-1 text-xs font-medium text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50">Voir</a>
                                        <a href="{{ route('filieres.edit', $filiere) }}" class="rounded-md px-3 py-1 text-xs font-medium text-sky-700 ring-1 ring-sky-200 hover:bg-sky-50">Modifier</a>
                                        <form action="{{ route('filieres.destroy', $filiere) }}" method="POST" onsubmit="return confirm('Supprimer cette filière ?');" class="inline">
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
                {{ $filieres->links() }}
            </div>
        @endif
    </div>
@endsection
