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

    <h1 class="text-center">Location</h1>
    <hr>
    <!-- Add Location button modal -->
    
    <table class="table align-items-center" id="table-content">
        
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <button type="button" class="btn btn-primary mb-3 float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Location
    </button>
@endsection
