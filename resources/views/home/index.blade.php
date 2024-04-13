@extends('layout')

@section('title')
    <title>Homes</title>
@endsection

@section('content')
    <h1>HOMES</h1>
    <h1>
        @if (session('success'))
            <div class="toast-container position-fixed bottom-0 start-0 p-6">
                <div class="toast alert success" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        <div class="d-flex gap-4">
                            <span><i class="fa-solid fa-circle-check fa-lg icon-success"></i></span>
                            <div class="d-flex flex-column flex-grow-1 gap-2">
                                <div class="d-flex align-items-center">
                                    <span class="fw-semibold"><b>{{ session('success') }}</b></span>
                                    <button type="button" class="btn-close btn-close-sm ms-auto" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                                </div>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </h1>
    <ul class="breadcrumb">
        <li>Home</li>
    </ul>


    <a type="button" href="/home/create"><button>Create Home</button></a>
    <br><br>
    <form method="POST">
        @csrf
        <div class="form-floating">
            <select class="form-select" id="floatingSelect" name="pagination" onchange="this.form.submit()">
                <option value="5" @if ($pagination_size == 5) selected @endif>5</option>
                <option value="10" @if ($pagination_size == 10) selected @endif>10</option>
                <option value="15" @if ($pagination_size == 15) selected @endif>15</option>
            </select>
            <label for="floatingSelect">Items per Page:</label>
        </div>
    </form>

    {{ $homes->links() }}
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($homes as $home)
            <tr>
                <td>{{ $home->id }}</td>
                <td>{{ $home->name }}</td>
                <td>{{ $home->description }}</td>
                <td><a type="button" href="/home/edit/{{ $home->id }}"><button>Edit</button></a></td>
                <td>
                    <form method="POST" action="/home/delete/{{ $home->id }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $homes->links() }}
    @vite('resources/js/app.js')
@endsection
