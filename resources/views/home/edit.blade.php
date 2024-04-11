@extends('layout')

@section('content')
    <form method="POST" action="/home/edit/{{ $home->id }}">
        @method('PUT')
        @csrf
        <label for="fname">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $home->name }}"><br>
        <label for="lname">Description:</label><br>
        <input type="text" id="description" name="description" value="{{ $home->description }}"><br><br>
        <input type="submit" value="Submit">
    </form>
@endsection
