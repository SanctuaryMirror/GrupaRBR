<div class="mb-3">
    <label for="name" class="form-label">Nazwa zadania *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $task->name ?? '') }}" required>
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Opis</label>
    <textarea name="description" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="priority" class="form-label">Priorytet *</label>
    <select name="priority" class="form-control" required>
        @foreach(['low', 'medium', 'high'] as $option)
            <option value="{{ $option }}" @selected(old('priority', $task->priority ?? '') === $option)>
                {{ ucfirst($option) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status *</label>
    <select name="status" class="form-control" required>
        @foreach(['to-do' => 'Do zrobienia', 'in progress' => 'W trakcie', 'done' => 'Zrobione'] as $key => $label)
            <option value="{{ $key }}" @selected(old('status', $task->status ?? '') === $key)>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="due_date" class="form-label">Termin wykonania *</label>
    <input type="date" name="due_date" class="form-control"
           value="{{ old('due_date', isset($task) ? $task->due_date->format('Y-m-d') : '') }}" required>
</div>
