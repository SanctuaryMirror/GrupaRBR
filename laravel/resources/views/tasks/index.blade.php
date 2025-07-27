@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Moje zadania</h1>

        <div class="mb-4">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Dodaj nowe zadanie</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Nazwa</th>
                <th>Priorytet</th>
                <th>Status</th>
                <th>Termin</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->due_date->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edytuj</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Na pewno usunąć?')">Usuń</button>
                        </form>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info">Pokaż</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $tasks->links() }}
    </div>
@endsection
