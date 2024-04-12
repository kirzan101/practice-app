@extends('layout')

@section('content')
    <h1>HOMES</h1>
    <ul class="breadcrumb">
        <li><a href="/home">Home</a></li>
        <li>Create Home</li>
    </ul>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="/home/create">
        @csrf
        <label for="fname">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="lname">Description:</label><br>
        <input type="text" id="description" name="description"><br><br>
        <input type="submit" value="Submit">
    </form>
@endsection
