@extends('pages.manage.navigation')

@section('title', 'House Units')
@section('content')

    <h1 class="text-center">House Unit</h1>
    <hr>
    <table class="table align-items-center" id="table-content">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($units as $unit)
                <tr>
                    <td>{{ $unit->id }}</td>
                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->location->location }}</td>
                    <td>{{ $unit->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
