<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(): View
    {
        $teachers = Teacher::orderBy('last_name')->orderBy('first_name')->paginate(15);

        return view('teachers.index', compact('teachers'));
    }

    public function create(): View
    {
        return view('teachers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:teachers,email'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Enseignant ajouté.');
    }

    public function edit(Teacher $teacher): View
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:teachers,email,' . $teacher->id],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Enseignant mis à jour.');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Enseignant supprimé.');
    }
}