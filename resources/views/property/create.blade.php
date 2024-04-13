@extends('layout')

@section('content')
    <h1>PROPERTIES</h1>
    <!-- /resources/views/post/create.blade.php -->

    <ul class="breadcrumb">
        <li><a href="/properties">Property</a></li>
        <li>Create Property</li>
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

    <!-- Create Post Form -->
    <form method="POST" action="/properties">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description"><br>
        <label for="home_id">Choose a Home:</label>
        <select name="home_id" id="home_id">
            @foreach ($homes as $home)
                <option value="{{ $home->id }}">{{ $home->name }}</option>
            @endforeach
        </select>
        <br>
        <input type="submit" value="Submit">
    </form>
@endsection
