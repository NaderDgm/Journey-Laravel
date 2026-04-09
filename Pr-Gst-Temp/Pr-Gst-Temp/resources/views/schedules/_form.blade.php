<div class="grid gap-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="group_id">Groupe</label>
        <select
            id="group_id"
            name="group_id"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            required
        >
            <option value="">-- Choisir un groupe --</option>
            @foreach($groups as $group)
                <option value="{{ $group->id }}" {{ old('group_id', $schedule->group_id ?? '') == $group->id ? 'selected' : '' }}>
                    {{ $group->code }} ({{ $group->filiere->name ?? '' }} - {{ $group->year }}ème)
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-700" for="title">Intitulé</label>
        <input
            id="title"
            name="title"
            value="{{ old('title', $schedule->title ?? '') }}"
            class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            placeholder="ex. Cours de Maths"
            required
        />
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700" for="day">Jour</label>
            <select
                id="day"
                name="day"
                class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                required
            >
                <option value="">-- Choisir un jour --</option>
                @foreach($days as $day)
                    <option value="{{ $day }}" {{ old('day', $schedule->day ?? '') === $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700" for="slot">Créneau</label>
            <select
                id="slot"
                name="slot"
                class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                required
            >
                <option value="">-- Choisir un créneau --</option>
                @foreach($slots as $start => $end)
                    <option value="{{ $start }}" {{ old('slot', $schedule->start_time ?? '') === $start ? 'selected' : '' }}>
                        {{ substr($start, 0, 5) }} - {{ substr($end, 0, 5) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700" for="room_id">Salle</label>
            <select
                id="room_id"
                name="room_id"
                class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            >
                <option value="">-- Laisser vide ou saisir manuellement --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id', $schedule->room_id ?? '') == $room->id ? 'selected' : '' }}>{{ $room->name }} {{ $room->location ? "({$room->location})" : '' }}</option>
                @endforeach
            </select>

            <input
                id="room"
                name="room"
                value="{{ old('room', $schedule->room ?? '') }}"
                class="mt-2 w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                placeholder="ou saisissez une salle libre"
            />
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700" for="teacher_id">Enseignant</label>
            <select
                id="teacher_id"
                name="teacher_id"
                class="w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
            >
                <option value="">-- Laisser vide ou saisir manuellement --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $schedule->teacher_id ?? '') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->full_name }}{{ $teacher->email ? " ({$teacher->email})" : '' }}
                    </option>
                @endforeach
            </select>

            <input
                id="teacher"
                name="teacher"
                value="{{ old('teacher', $schedule->teacher ?? '') }}"
                class="mt-2 w-full rounded border border-slate-200 bg-white px-3 py-2 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                placeholder="ou saisissez un nom d'enseignant"
            />
        </div>
    </div>
</div>
