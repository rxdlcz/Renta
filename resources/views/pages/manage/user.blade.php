@extends('layout.navigation')

@section('title', 'Users')
@section('content')

    <div class="content-header">
        <div class="d-flex">
            <span>
                <img src="img/icon/userKey.png" alt="">
            </span>
            <h1 class="mx-3">Users</h1>
        </div>

        <!-- Add User button modal -->
        <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#addModal">
            <span class="button__text">Add User</span>
            <span class="button__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                </svg>
            </span>
        </button>
    </div>
    <hr>
    <table class="table align-items-center" id="table-content">
        <thead>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastame</th>
                <th>Email</th>
                <th>username</th>
                <th class="no-sort text-center">Action</th>
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
                    <td><button class='btn bg-info edit ml-2' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>
                        <button class='btn bg-info del ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Add Modal  id="addForm" class="addFormModal" --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " >Register User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addUser" method="post" id="addForm" class="addFormModal">
                    @csrf
                    <div class="modal-body mt-3">

                        <label class="mx-1">Firstname</label>
                        <input type="text" name="firstname" class="form-control" required>
                        <span class="txt_error text-danger mx-1 firstname_error"></span>

                        <label class="mx-1">Lastname</label>
                        <input type="text" name="lastname" class="form-control" required>
                        <span class="txt_error text-danger mx-1 lastname_error"></span>

                        <label class="mx-1">Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <span class="txt_error text-danger mx-1 email_error"></span>

                        <label class="mx-1">Username</label>
                        <input type="text" name="username" class="form-control" required>
                        <span class="txt_error text-danger mx-1 username_error"></span>

                        <label class="mx-1">Password</label>
                        <input type="password" name="password" class="form-control" minlength="8" required>
                        <span class="txt_error text-danger mx-1 password_error"></span>

                        <label class="mx-1">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" minlength="8" required>
                        <span class="txt_error text-danger mx-1 confirm_password_error"></span>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Modal --}}

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " >Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/editUser" method="post" id="editForm" class="editFormModal">
                    @csrf
                    <div class="modal-body mt-3" id="modalInput">
                        <label class="mx-1">Firstname</label>
                        <input type="text" name="firstname" class="form-control" required>
                        <span class="txt_error text-danger mx-1 firstname_error"></span>

                        <label class="mx-1">Lastname</label>
                        <input type="text" name="lastname" class="form-control" required>
                        <span class="txt_error text-danger mx-1 lastname_error"></span>

                        <label class="mx-1">Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <span class="txt_error text-danger mx-1 email_error"></span>

                        <label class="mx-1">Username</label>
                        <input type="text" name="username" class="form-control" >
                        <span class="txt_error text-danger mx-1 username_error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- End Edit Modal --}}

    {{-- Delete modal confirmation --}}
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deleteUser" method="post" id="delForm" class="delFormModal">
                    @csrf
                    <div class="modal-body mt-3">
                        <h4 id="delLocName"></h4>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- End Delete Modal confirmation --}}

@endsection
