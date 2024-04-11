@extends('layout')

@section('content')
    <h1>
        @if (session('success'))
            {{ session('success') }}
        @endif
    </h1>

    <a type="button" href="/properties/create">create Me!</a>
    @foreach ($properties as $property)
        <p>{{ $property->name }} - {{ $property->description }} |
            <b>{{ $property->home->name }}</b>
            <h1>{{ $property->getSample() }}</h1>
            <a type="button" href="/properties/{{ $property->id }}/edit">Click Me!</a> |
        <form method="POST" action="/properties/{{ $property->id }}">
            @method('DELETE')
            @csrf
            <button type="submit">Delete Me!</button>
        </form>
        </p>
    @endforeach
@endsection
