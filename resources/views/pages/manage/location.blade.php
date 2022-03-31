@extends('pages.manage.navigation')

@section('title', 'Locations')
@section('content')
    @if (Session::has('success'))
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">Successfully Added</span>
            <div class="close-btn">
                <span class="fas fa-times">X</span>
            </div>
        </div>
    @endif

    @if (Session::has('fail'))
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">Unknown Error: Failed to add</span>
            <div class="close-btn">
                <span class="">X</span>
            </div>
        </div>
    @endif

    @error('location')
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">Existing Location name</span>
            <div class="close-btn">
                <span class="">X</span>
            </div>
        </div>
    @enderror

    <div class="content-header">
        <h1 class="">Location</h1>

        <!-- Add Location button modal -->
        <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#addModal">
            <span class="button__text">Add Location</span>
            <span class="button__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                  </svg>
            </span>
        </button>
    </div>

    <hr>

    <table class="table align-items-center" id="table-content" width="400">

        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->location }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>




    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Add Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="addLocation" method="post">
                    @csrf
                    <div class="modal-body mt-3">

                        <label for="">Location Name</label>
                        <input type="text" class="form-control" name="location" required>

                    </div>
                    <div class="modal-footer mt-4">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection
