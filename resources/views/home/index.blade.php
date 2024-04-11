@extends('layout')

@section('title')
    <title>Homes</title>
@endsection

@section('content')
    <h1>HOMES</h1>
    <h1>
        @if (session('success'))
            {{ session('success') }}
        @endif
    </h1>

    <a type="button" href="/home/create"><button>Create Home</button></a>
    <br><br>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($homes as $home)
            <tr>
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
@endsection
