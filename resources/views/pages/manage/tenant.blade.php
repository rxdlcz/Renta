@extends('pages.manage.navigation')
@section('title', 'Tenants')

@section('content')

<h1 class="text-center">Tenants</h1>
<hr>
<table class="table align-items-center" id="table-content">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Unit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tenants as $tenant)
            <tr>
                <td>{{ $tenant->id }}</td>
                <td>{{ $tenant->firstname }} {{ $tenant->lastname }}</td>
                <td>{{ $tenant->location->location }}</td>
                <td>{{ $tenant->unit->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop