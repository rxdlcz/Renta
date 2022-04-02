@extends('pages.manage.navigation')

@section('title', 'Locations')

@section('content')

    {{-- Error Handling --}}
    @if (Session::has('success'))
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">{{ Session::get('success') }}</span>
            <div class="close-btn">
                <span class="fas fa-times">X</span>
            </div>
        </div>
    @endif

    @if (Session::has('fail'))
        <div class="alert showAlert show">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">{{ Session::get('fail') }}</span>
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
    {{-- End of Error Handling --}}

    <div class="content-header">
        <h1 class="">Location</h1>

        {{-- Add Location button modal --}}
        <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#addModal">
            <span class="button__text">Add Location</span>
            <span class="button__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                </svg>
            </span>
        </button>
    </div>
    {{-- End Add Location button modal --}}

    <hr>

    {{-- Table --}}
    <table class="table align-items-center" id="table-content" width="400">

        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th class="no-sort text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->location }}</td>
                    <td class="text-center">
                        <button class="btn bg-info edit" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                        <button class="btn bg-info del" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </td>

                </tr>
            @endforeach --}}
        </tbody>
    </table>
    {{-- End of Table --}}


    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Add Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addLocation" method="post" id="addForm">
                    @csrf
                    <div class="modal-body mt-3">
                        <label>Location Name</label>
                        <input type="text" class="form-control" name="location" required>

                    </div>
                    <div class="modal-footer mt-4">
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
                <form action="editLocation" method="post" id="editForm">
                    @csrf
                    <div class="modal-body mt-3">
                        <label>Location Name</label>
                        <input type="text" id="editLocName" class="form-control" name="location" required>
                    </div>
                    <div class="modal-footer mt-4">
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
                <form action="deleteLocation" method="post" id="delForm">
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

@section('javascript')
    <script>
        $(document).ready(function() {
            //console.log({!! $data !!});
            var table = $('#table-content').DataTable();

            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();

                $('#editLocName').val(data[1]);
                $('#editForm').attr('action', '/editLocation/' + data[0]);
            })
            table.on('click', '.del', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();

                $('#delLocName').html('Confirm Deletion of : ' + data[1]);
                $('#delForm').attr('action', '/deleteLocation/' + data[0]);
            })

            getTenants();

            function getTenants() {
                var myTable = $( "#table-content" ).DataTable();

                $.ajax({
                    type: "GET",
                    url: "/locationData",
                    dataType: "json",
                    success: function(response) {
                        console.log(response.locations);
                        $.each(response.locations, function(key, item) {
                            $('tbody').append('\
                                <tr>\
                                    <td>' + item.id + '</td>\
                                    <td>' + item.location + '</td>\
                                    <td class="text-center">\
                                    <button class="btn bg-info edit" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>\
                                    <button class="btn bg-info del" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>\
                                    </td>\
                                </tr>\
                            ');
                        });
                        
                    }

                });
            }

        });
        $(function() {

            $('#addForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/addLocation",
                    processData: false,
                    data: $('#addForm').serialize(),
                    beforeSend: function() {},
                    success: function(data) {
                        /* if (data.status) {
                            window.location.href = "/location";
                        } else {
                            $('.alert-danger').css("display", "block");
                        } */
                        alert('Success');
                    }
                });
            });
        });
    </script>
@endsection
