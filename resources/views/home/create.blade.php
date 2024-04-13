@extends('layout')

@section('content')
    <div class="toast-container position-fixed bottom-0 start-0 p-6">
        <div class="toast" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <div class="d-flex gap-4">
                    <span><i class="fa-solid fa-circle-check fa-lg icon-success"></i></span>
                    <div class="d-flex flex-column flex-grow-1 gap-2">
                        <div class="d-flex align-items-center">
                            <span class="fw-semibold">#1 Your changes were saved</span>
                            <button type="button" class="btn-close btn-close-sm ms-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <span>I will auto dismiss after 8 seconds.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <form method="POST">
        @csrf
        <label for="fname">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="lname">Description:</label><br>
        <input type="text" id="description" name="description"><br><br>
        <input type="submit" value="Submit">
    </form>
@endsection
