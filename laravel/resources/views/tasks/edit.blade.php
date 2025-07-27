@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edytuj zadanie</h1>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            @include('tasks.form')
            <button type="submit" class="btn btn-primary mt-3">Aktualizuj</button>
        </form>
    </div>
@endsection
