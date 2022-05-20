@extends('layout.navigation')

@section('title', 'Locations')

@section('content')

    <div class="content-header">
        <div class="d-flex">
            <span>
                <img src="img/icon/location.png" alt="">
            </span>
            <h1 class="mx-3">Location</h1>
        </div>

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
    <table class="table align-items-center table-hover" id="table-content">

        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Description</th>
                <th class="no-sort text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->id }}</td>
                    <td>{{ $location->location }}</td>
                    <td>{{ $location->description }}</td>
                    <td>
                        <button class='btn bg-info upload ml-2' data-bs-toggle='modal' data-bs-target='#uploadModal'>Upload
                            Image</button>
                        <button class='btn bg-info edit ml-2' data-bs-toggle='modal'
                            data-bs-target='#editModal'>Edit</button>
                        <button class='btn bg-info del ml-2' data-bs-toggle='modal'
                            data-bs-target='#deleteModal'>Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- End of Table --}}


    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Add Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addLocation" method="post" id="addForm" class="addFormModal">
                    @csrf
                    <div class="modal-body mt-3">
                        <label class="mx-1">Location Name</label>
                        <input type="text" class="form-control" name="location" required>
                        <span class="txt_error text-danger mx-1 location_error"></span>

                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                        <span class="txt_error text-danger mx-1 description_error"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Modal --}}

    {{-- Upload image Modal --}}
    <div class="modal fade" id="uploadModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/uploadLocation" method="post" id="uploadForm" enctype="multipart/form-data"
                    class="uploadFormModal">
                    @csrf
                    <div class="modal-body mt-3">
                        <label for="formFileSm" class="form-label">Choose Image</label>
                        <input class="form-control form-control-sm" name="image" type="file">

                        <div class="img-wrapper d-flex justify-content-center mt-3 p-2 bg-secondary"
                            style="max-height:400px; min-height:300px">
                            <img src="img/defaultUpload.png" alt="" class="img-fluid" id="img-preview-result">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="cropModalLocation" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-3">
                    <div class="crop-image" id="img-preview-crop"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="cropImageLocation">Crop and Save</button>
                </div>

            </div>
        </div>
    </div>
    {{-- End Upload image Modal --}}

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Edit Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="editLocation" method="post" id="editForm" class="editFormModal">
                    @csrf
                    <div class="modal-body mt-3" id="modalInput">
                        <label class="mx-1">Location Name</label>
                        <input type="text" id="editLocName" class="form-control" name="location" required>
                        <span class="txt_error text-danger mx-1 location_error"></span>

                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                        <span class="txt_error text-danger mx-1 description_error"></span>
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
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="delModalLabel"
        aria-hidden="true">
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

@section('javascript')
    <script>
        //Pass selected file to Crop modal

        $(document).ready(function() {
            //croppie attributes
            $image_crop = $('#img-preview-crop').croppie({
                enableExif: true,
                viewport: {
                    width: 350,
                    height: 350,
                },
                boundary: {
                    width: 400,
                    height: 400
                },
            });
        });

        $("#uploadForm input").change(function() {
            var fileExtension = ['jpeg', 'jpg', 'png'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".profileImg_error").text("Only formats are allowed : " + fileExtension.join(', '));
            } else {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        //console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#cropModalLocation').modal('toggle');
            }
        });

        //cropped image
        $('#cropImageLocation').click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {
                document.getElementById('img-preview-result').src = response;
            })
            $('#cropModalLocation').modal('hide');
        });

        $('.uploadFormModal').on('submit', function(e) {

            e.preventDefault();
            var response = $('#img-preview-result').attr('src');
            var formData = new FormData(this);
            var actionUrl = $(this).attr('action');
            var type = $(this).attr('method');

            try {
                $.ajax({
                    url: actionUrl,
                    type: type,
                    data: {
                        "image": response,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        //document.getElementById('img-temp').src = response;
                        //showValidation(0, "Profile Image Updated");
                        console.log(data);
                    }
                })
            } catch (error) {
                console.log('Error:', error);
            }
        });
    </script>
@endsection
