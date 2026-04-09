<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="name">Nom</label>
        <input
            id="name"
            name="name"
            value="{{ old('name', $room->name ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            required
        />
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="location">Emplacement</label>
        <input
            id="location"
            name="location"
            value="{{ old('location', $room->location ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            placeholder="Bâtiment A, étage 2"
        />
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="capacity">Capacité</label>
        <input
            id="capacity"
            name="capacity"
            type="number"
            min="1"
            value="{{ old('capacity', $room->capacity ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            placeholder="Ex. 30"
        />
    </div>
</div>
