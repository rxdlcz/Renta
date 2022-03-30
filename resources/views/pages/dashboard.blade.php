@extends('pages.manage.navigation')

@section('title', 'Dashboard')
@section('content')

<h1 class="text-center">Dashboard</h1>
            <hr>
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>username</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @stop