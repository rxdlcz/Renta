@extends('pages.manage.navigation')

@section('title', 'Users')
@section('content')

    {{-- Error Handling --}}
    @if (Session::has('success'))
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">Successfully Registered</span>
            <div class="close-btn">
                <span class="fas fa-times">X</span>
            </div>
        </div>
    @endif

    @if (Session::has('fail'))
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">Unknown Error: Failed to Registered</span>
            <div class="close-btn">
                <span class="">X</span>
            </div>
        </div>
    @endif

    @error('email')
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">Existing Email Address</span>
            <div class="close-btn">
                <span class="">X</span>
            </div>
        </div>
    @enderror
    @error('username')
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">Existing Username</span>
            <div class="close-btn">
                <span class="">X</span>
            </div>
        </div>
    @enderror {{-- End of Error Handling --}}

    <h1 class="text-center">Users</h1>
    <hr>
    <table class="table align-items-center" id="table-content">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>username</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Register User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('register-user') }}" method="post">
                    @csrf
                    <div class="modal-body mt-3">

                        <label for="">First Name</label>
                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}"
                            required>
                        <label for="">Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" minlength="8" required>

                    </div>
                    <div class="modal-footer mt-4">
                        <input type="submit" class="btn btn-primary" value="Register User">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Location button modal -->
    <button type="button" class="btn btn-primary mb-3 float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add User
    </button>

@endsection
