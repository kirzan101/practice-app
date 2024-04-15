@extends('layout')

@section('content')
    <h1>PROPERTIES</h1>
    <ul class="breadcrumb">
        <li><a href="/properties">Property</a></li>
        <li>Edit Property</li>
    </ul>
    <form method="POST" action="/properties/{{ $property->id }}">
        @method('PUT')
        @csrf
        <label for="fname">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $property->name }}"><br>
        <label for="lname">Description:</label><br>
        <input type="text" id="description" name="description" value="{{ $property->description }}"><br><br>
        <label for="cars">Choose a home:</label>
        <select name="home_id" id="home_id">
            @foreach ($homes as $home)
                <option value="{{ $home->id }}" {{ $home->id === $property->home_id ? 'selected' : '' }}>
                    {{ $home->name }}</option>
            @endforeach
        </select>
        <br>
        <input type="submit" value="Submit">
    </form>
@endsection
