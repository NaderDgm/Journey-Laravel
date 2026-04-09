@extends('layouts.app')

@section('title', "Filière : {$filiere->name}")

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="flex flex-col gap-4 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">{{ $filiere->name }}</h1>
                    <p class="mt-1 text-sm text-slate-600">Détails de la filière.</p>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('filieres.edit', $filiere) }}" class="rounded-md border border-sky-200 bg-sky-50 px-4 py-2 text-sm font-semibold text-sky-700 hover:bg-sky-100">Modifier</a>
                    <a href="{{ route('filieres.index') }}" class="rounded-md border border-slate-200 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Retour</a>
                </div>
            </div>

            <div class="mt-4 space-y-4">
                <div>
                    <h2 class="text-sm font-semibold text-slate-700">Description</h2>
                    <p class="mt-1 text-slate-600">{{ $filiere->description ?? 'Aucune description.' }}</p>
                </div>

                <div class="flex flex-wrap gap-3 text-sm">
                    <span class="rounded bg-slate-100 px-3 py-1 text-slate-700">Créé le {{ $filiere->created_at->format('d/m/Y') }}</span>
                    <span class="rounded bg-slate-100 px-3 py-1 text-slate-700">Mis à jour le {{ $filiere->updated_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
