<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="code">Code du groupe</label>
        <input
            id="code"
            name="code"
            value="{{ old('code', $group->code ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            required
        />
        <p class="mt-1 text-xs text-slate-500">Ex : DEV101, AI202</p>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700" for="filiere_id">Filière</label>
            <select
                id="filiere_id"
                name="filiere_id"
                class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                required
            >
                <option value="">-- Choisir une filière --</option>
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}" {{ old('filiere_id', $group->filiere_id ?? '') == $filiere->id ? 'selected' : '' }}>
                        {{ $filiere->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700" for="year">Année</label>
            <select
                id="year"
                name="year"
                class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                required
            >
                <option value="">-- Choisir --</option>
                <option value="1" {{ old('year', $group->year ?? '') == 1 ? 'selected' : '' }}>1ère année</option>
                <option value="2" {{ old('year', $group->year ?? '') == 2 ? 'selected' : '' }}>2ème année</option>
            </select>
        </div>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="teacher_ids">Formateurs</label>
        <select
            id="teacher_ids"
            name="teacher_ids[]"
            multiple
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
        >
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ in_array($teacher->id, old('teacher_ids', $group->teachers->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                    {{ $teacher->full_name }}
                </option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-slate-500">Maintenez la touche Ctrl pour sélectionner plusieurs.</p>
    </div>
</div>
