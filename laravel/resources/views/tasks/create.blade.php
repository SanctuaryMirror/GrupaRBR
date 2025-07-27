@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dodaj nowe zadanie</h1>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            @include('tasks.form')
            <button type="submit" class="btn btn-primary mt-3">Zapisz</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Wystąpiły błędy:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
