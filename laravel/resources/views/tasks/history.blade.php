@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Historia zmian zadania: <strong>{{ $task->name }}</strong></h1>

        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mb-3">← Wróć do listy zadań</a>

        @if($histories->isEmpty())
            <div class="alert alert-info">Brak historii zmian dla tego zadania.</div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Data zmiany</th>
                    <th>Użytkownik</th>
                    <th>Nazwa</th>
                    <th>Opis</th>
                    <th>Priorytet</th>
                    <th>Status</th>
                    <th>Termin</th>
                </tr>
                </thead>
                <tbody>
                @foreach($histories as $history)
                    <tr>
                        <td>{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $history->user?->name ?? 'Nieznany' }}</td>
                        <td>{{ $history->name }}</td>
                        <td>{{ $history->description }}</td>
                        <td>{{ ucfirst($history->priority) }}</td>
                        <td>{{ ucfirst($history->status) }}</td>
                        <td>{{ $history->due_date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
