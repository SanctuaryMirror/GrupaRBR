@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Zadanie publiczne</h2>

        <ul class="list-group">
            <li class="list-group-item"><strong>Nazwa:</strong> {{ $task->name }}</li>
            <li class="list-group-item"><strong>Opis:</strong> {{ $task->description }}</li>
            <li class="list-group-item"><strong>Priorytet:</strong> {{ ucfirst($task->priority) }}</li>
            <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($task->status) }}</li>
            <li class="list-group-item"><strong>Termin:</strong> {{ $task->due_date->format('Y-m-d') }}</li>
        </ul>
    </div>
@endsection
