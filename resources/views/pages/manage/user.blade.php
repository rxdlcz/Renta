@extends('pages.manage.navigation')

@section('title', 'Users')
@section('content')

    {{-- Error Handling --}}

    {{-- End of Error Handling --}}

    <div class="content-header">
        <h1 class="">Users</h1>

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
        </tbody>
    </table>

    {{-- Add Modal  id="addForm" class="addFormModal" --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Register User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addUser" method="post" id="addForm" class="addFormModal">
                    @csrf
                    <div class="modal-body mt-3">
                        {{-- <label class="mx-1">Firstname</label>
                        <input type="text" class="form-control" name="firstname" required>
                        <span class="msg text-danger mx-1"></span>

                        <label class="mx-1">Lastname</label>
                        <input type="text" class="form-control" name="lastname" required>
                        <span class="msg text-danger mx-1"></span>

                        <label class="mx-1">Email</label>
                        <input type="text" class="form-control" name="email" required>
                        <span class="msg text-danger mx-1"></span>

                        <label class="mx-1">Username</label>
                        <input type="text" class="form-control" name="username" required>
                        <span class="msg text-danger mx-1"></span>

                        <label class="mx-1">password</label>
                        <input type="password" class="form-control" name="password" minlength="8" required>
                        <span class="msg text-danger mx-1"></span> --}}

                        <label for="">First Name</label>
                        <input type="text" name="firstname" class="form-control" required>
                        <label for="">Last Name</label>
                        <input type="text" name="lastname" class="form-control" required>
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" required>
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" minlength="8" required>
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Edit Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/editUser" method="post" id="editForm" class="editFormModal">
                    @csrf
                    <div class="modal-body mt-3">
                        <label class="mx-1">Location Name</label>
                        <input type="text" id="editLocName" class="form-control" name="location" required>
                        <span class="msg text-danger mx-1"></span>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Delete Location</h5>
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
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- End Delete Modal confirmation --}}

@endsection
