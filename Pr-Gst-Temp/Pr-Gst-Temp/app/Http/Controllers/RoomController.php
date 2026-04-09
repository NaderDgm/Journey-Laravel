<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(): View
    {
        $rooms = Room::orderBy('name')->paginate(15);

        return view('rooms.index', compact('rooms'));
    }

    public function create(): View
    {
        return view('rooms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:rooms,name'],
            'location' => ['nullable', 'string', 'max:255'],
            'capacity' => ['nullable', 'integer', 'min:1'],
        ]);

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Salle ajoutée.');
    }

    public function edit(Room $room): View
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:rooms,name,' . $room->id],
            'location' => ['nullable', 'string', 'max:255'],
            'capacity' => ['nullable', 'integer', 'min:1'],
        ]);

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Salle mise à jour.');
    }

    public function destroy(Room $room): RedirectResponse
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Salle supprimée.');
    }
}