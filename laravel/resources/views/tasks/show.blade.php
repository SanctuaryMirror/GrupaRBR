@extends('layouts.app')

@section('content')
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>

    <h3>Historia zmian</h3>

    @if($histories->isEmpty())
        <p>Brak zapisanych zmian.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Data</th>
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
                    <td>{{ $history->created_at->format('Y-m-d H:i') }}</td>
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

    @if(session('public_link'))
        <div class="mt-4 p-3 bg-green-100 border border-green-400 rounded">
            Publiczny link do zadania (ważny 60 minut):
            <a href="{{ session('public_link') }}" target="_blank" class="text-blue-600 underline">
                {{ session('public_link') }}
            </a>
        </div>
    @endif

    <form action="{{ route('tasks.generatePublicLink', $task) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mt-4">
            Wygeneruj publiczny link
        </button>
    </form>


@endsection
