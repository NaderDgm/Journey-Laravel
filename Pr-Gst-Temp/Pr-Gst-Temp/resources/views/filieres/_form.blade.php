<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="name">Nom de la filière</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $filiere->name ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            placeholder="ex. Informatique"
            required
        />
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="description">Description (optionnelle)</label>
        <textarea
            id="description"
            name="description"
            rows="4"
            class="w-full resize-none rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            placeholder="Une brève description de la filière..."
        >{{ old('description', $filiere->description ?? '') }}</textarea>
    </div>
</div>
