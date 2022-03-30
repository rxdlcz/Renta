@extends('pages.manage.navigation')
@section('title', 'Tenants')

@section('content')

<h1 class="text-center">Tenants</h1>
<hr>
<table class="table align-items-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Unit</th>
            <th>Rent</th>
            <th>Electric</th>
            <th>Water</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tenants as $tenant)
            <tr>
                <td>{{ $tenant->id }}</td>
                <td>{{ $tenant->firstname }} {{ $tenant->lastname }}</td>
                <td>{{ $tenant->location->location }}</td>
                <td>{{ $tenant->unit->name }}</td>
                <td>{{ $tenant->bills_id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop