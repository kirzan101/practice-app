@extends('layout')

@section('content')
    <h1>
        @if (session('success'))
            {{ session('success') }}
        @endif
    </h1>

    <a type="button" href="/home/create">create Me!</a>
    @foreach ($homes as $home)
        <p>{{ $home->name }} - {{ $home->description }} |
            <a type="button" href="/home/edit/{{ $home->id }}">Click Me!</a> |
        <form method="POST" action="/home/delete/{{ $home->id }}">
            @method('DELETE')
            @csrf
            <button type="submit">Delete Me!</button>
        </form>
        </p>
    @endforeach
@endsection
