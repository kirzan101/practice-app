@extends('layout')

@section('content')
    <form method="POST" action="/home/create">
        @csrf
        <label for="fname">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="lname">Description:</label><br>
        <input type="text" id="description" name="description"><br><br>
        <input type="submit" value="Submit">
    </form>
@endsection
