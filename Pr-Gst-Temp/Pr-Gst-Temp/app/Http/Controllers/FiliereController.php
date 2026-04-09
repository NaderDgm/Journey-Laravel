<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FiliereController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index(): View
    {
        $filieres = Filiere::orderBy('name')->paginate(10);

        return view('filieres.index', compact('filieres'));
    }

    public function create(): View
    {
        return view('filieres.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:filieres,name'],
            'description' => ['nullable', 'string'],
        ]);

        Filiere::create($validated);

        return redirect()->route('filieres.index')->with('success', 'Filière créée avec succès.');
    }

    public function show(Filiere $filiere): View
    {
        return view('filieres.show', compact('filiere'));
    }

    public function edit(Filiere $filiere): View
    {
        return view('filieres.edit', compact('filiere'));
    }

    public function update(Request $request, Filiere $filiere): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:filieres,name,' . $filiere->id],
            'description' => ['nullable', 'string'],
        ]);

        $filiere->update($validated);

        return redirect()->route('filieres.index')->with('success', 'Filière mise à jour avec succès.');
    }

    public function destroy(Filiere $filiere): RedirectResponse
    {
        $filiere->delete();

        return redirect()->route('filieres.index')->with('success', 'Filière supprimée.');
    }
}