@extends('pages.manage.navigation')

@section('title', 'Locations')

@section('content')

    <div class="content-header">
        <h1 class="">Location</h1>

        {{-- Add Location button modal --}}
        <button type="button" class="button add" data-bs-toggle="modal" data-bs-target="#addModal">
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
    <table class="table align-items-center" id="table-content">

        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th class="no-sort text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
            <tr>
                <td>{{ $location->id }}</td>
                <td>{{ $location->location }}</td>
                <td><button class='btn bg-info edit ml-2' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>
                    <button class='btn bg-info del ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- End of Table --}}


    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " >Add Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addLocation" method="post" id="addForm" class="addFormModal">
                    @csrf
                    <div class="modal-body mt-3">
                        <label class="mx-1">Location Name</label>
                        <input type="text" class="form-control" name="location" required>
                        <span class="msg text-danger mx-1"></span>
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
                    <h5 class="modal-title " >Edit Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="editLocation" method="post" id="editForm" class="editFormModal">
                    @csrf
                    <div class="modal-body mt-3" id="modalInput">
                        <label class="mx-1">Location Name</label>
                        <input type="text" id="editLocName" class="form-control" name="location" required>
                        <span class="txt_error text-danger mx-1 location_error"></span>
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
                    <h5 class="modal-title text-white">Delete Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="deleteLocation" method="post" id="delForm" class="delFormModal">
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

{{-- //Add Function
    $('.addFormModal').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this);
        var actionUrl = $(this).attr('action');
        var type = $(this).attr('method');

        /* $.ajax({
            type: "POST",
            url: actionUrl,
            processData: false,
            data: $(formData).serialize(),
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 1) {
                    alert('Success');
                    getTenants();
                } else {
                    console.log(data.error);
                }
            }
        }); */
        ajaxFunction(formData, actionUrl, type);
    }); --}}


{{-- function getTenants() {
        let itemKey = [];
        let button =
            "<button class='btn bg-info edit ml-2' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button>\
                <button class='btn bg-info del ml-2' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>";

        $.ajax({
            type: "GET",
            url: "/location",
            dataType: "json",
            success: function(response) {
                $("#table-content").DataTable().clear();
                
                $.each(response.locations, function(key, item) {
                    //let itemArray = [];
                    
                    
                    itemKey = item;

                    let itemArray = [item['id'], item['location'], button];
                    //console.log(itemArray);
                    

                    //$('#table-content').dataTable().fnAddData(itemArray);

                    /* let objectKeys = Object.keys(item);
                    console.log(objectKeys[0]);

                    itemArray.push(item['id']);
                    $('#table-content').dataTable().fnAddData(itemArray); */

                    
                });
                let objectKeys = Object.keys(itemKey);
                console.log(objectKeys);
                //console.log(itemKey);
            }
        });
    } --}}
