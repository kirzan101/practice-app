@extends('layout')

@section('content')
    <form method="POST" action="/properties">
        @csrf
        <label for="fname">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="lname">Description:</label><br>
        <input type="text" id="description" name="description"><br>
        <label for="cars">Choose a car:</label>
        <select name="home_id" id="home_id">
            @foreach ($homes as $home)
                <option value="{{$home->id}}">{{$home->name}}</option>
            @endforeach
        </select>
        <br>
        <input type="submit" value="Submit">
    </form>
@endsection