@extends('layouts.app')

@section('title', 'Ajouter un créneau')

@section('content')
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-semibold text-slate-900">Ajouter un créneau</h1>
        <p class="mt-1 text-sm text-slate-600">Planifiez un créneau dans l'emploi du temps.</p>

        <form action="{{ route('schedules.store') }}" method="POST" class="mt-6 space-y-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf

            @include('schedules._form')

            <div class="flex items-center gap-2">
                <a href="{{ route('schedules.index') }}" class="rounded-md border border-slate-200 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Annuler</a>
                <button type="submit" class="rounded-md bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">Enregistrer</button>
            </div>
        </form>
    </div>
@endsection
