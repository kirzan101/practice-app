@extends('layout')

@section('title')
    <title>Properties</title>
@endsection

@section('content')
    <h1>PROPERTIES</h1>
    <h1>
        @if (session('success'))
            <div class="alert success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
    </h1>
    <ul class="breadcrumb">
        <li>Property</li>
    </ul>

    <a type="button" href="/properties/create"><button>Create Property</button></a>
    <br><br>

    <table>
        <tr>
            <th>Property Name</th>
            <th>Description</th>
            <th>Home Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($properties as $property)
            <tr>
                <td>{{ $property->name }}</td>
                <td>{{ $property->description }}</td>
                <td><b>{{ $property->home->name }}</b></td>
                <td><a type="button" href="/properties/{{ $property->id }}/edit"><button>Edit</button></a></td>
                <td>
                    <form method="POST" action="/properties/{{ $property->id }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $properties->links() }}
@endsection
