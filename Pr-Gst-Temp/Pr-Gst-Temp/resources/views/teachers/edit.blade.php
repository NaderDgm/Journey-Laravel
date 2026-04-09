@extends('layouts.app')

@section('title', 'Modifier un professeur')

@section('content')
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-semibold text-slate-900">Modifier un professeur</h1>
        <p class="mt-1 text-sm text-slate-600">Mettez à jour les informations du professeur.</p>

        <form action="{{ route('teachers.update', $teacher) }}" method="POST" class="mt-6 space-y-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            @include('teachers._form')

            <div class="flex items-center gap-2">
                <a href="{{ route('teachers.index') }}" class="rounded-md border border-slate-200 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Annuler</a>
                <button type="submit" class="rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Enregistrer</button>
            </div>
        </form>
    </div>
@endsection
