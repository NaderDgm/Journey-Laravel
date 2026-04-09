<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="first_name">Prénom</label>
        <input
            id="first_name"
            name="first_name"
            value="{{ old('first_name', $teacher->first_name ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            required
        />
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="last_name">Nom</label>
        <input
            id="last_name"
            name="last_name"
            value="{{ old('last_name', $teacher->last_name ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            required
        />
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="email">Email</label>
        <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email', $teacher->email ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            placeholder="exemple@domaine.com"
        />
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="phone">Téléphone</label>
        <input
            id="phone"
            name="phone"
            value="{{ old('phone', $teacher->phone ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            placeholder="+33 6 12 34 56 78"
        />
    </div>
</div>
