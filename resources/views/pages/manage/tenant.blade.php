@extends('pages.manage.navigation')
@section('title', 'Tenants')

@section('content')

    <div class="content-header">
        <h1 class="">Tenants</h1>

        <!-- Add User button modal -->
        <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#addModal">
            <span class="button__text">Add Tenant</span>
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
                <th>Name</th>
                <th>Unit</th>
                <th>Contact Number</th>
                <th>Status</th>
                <th class="no-sort text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->id }}</td>
                    <td>{{ $tenant->firstname }} {{ $tenant->lastname }}</td>
                    <td>{{ $tenant->unit->name }}</td>
                    <td>{{ $tenant->contact_number }}</td>
                    <td>{{ $tenant->status }}</td>
                    <td><button class='btn bg-info detail ml-2' data-bs-toggle='modal'
                            data-bs-target='#tenantDetailModal'>View Tenant</button>
                        <button class='btn bg-info del ml-2' data-bs-toggle='modal'
                            data-bs-target='#deleteModal'>Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Add Modal  id="addForm" class="addFormModal" --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Add Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addTenant" method="post" id="addForm" class="addFormModal">
                    @csrf
                    <div class="modal-body mt-3">

                        <div class="row">
                            <div class="col-sm-6">
                                <label class="mx-1">Firstname</label>
                                <input type="text" name="firstname" class="form-control" required>
                                <span class="txt_error text-danger mx-1 firstname_error"></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="mx-1">Lastname</label>
                                <input type="text" name="lastname" class="form-control" required>
                                <span class="txt_error text-danger mx-1 lastname_error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label class="mx-1">Email</label>
                                <input type="email" name="email" class="form-control" required>
                                <span class="txt_error text-danger mx-1 email_error"></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="mx-1">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" required>
                                <span class="txt_error text-danger mx-1 contact_number_error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label class="mx-1">Occupation</label>
                                <input type="text" name="occupation_status" class="form-control" required>
                                <span class="txt_error text-danger mx-1 occupation_status_error"></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="mx-1">Unit</label>
                                <select class="form-select" name="unit_id" required>
                                    @foreach ($units as $unit)
                                        <option value={{ $unit->id }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                <span class="txt_error text-danger mx-1 unit_id_error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label class="mx-1">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                                <span class="txt_error text-danger mx-1 start_date_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="mx-1">End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                                <span class="txt_error text-danger mx-1 end_date_error"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="mx-1">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="3">Paid</option>
                                    <option value="4">Pending Balance</option>
                                    <option value="5">Unpaid Bills</option>
                                </select>
                                <span class="txt_error text-danger mx-1 status_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Modal --}}


    {{-- View Details modal --}}
    <div class="modal fade" id="tenantDetailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Tenant Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="detailForm py-2">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-detail"
                                aria-selected="true">Details</button>
                            <button class="nav-link" id="nav-bill-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-bill" type="button" role="tab" aria-controls="nav-bill"
                                aria-selected="false">Bills</button>
                            <button class="nav-link" id="nav-update-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-update" type="button" role="tab" aria-controls="nav-update"
                                aria-selected="false">Update</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-detail" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="modal-body ">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="mx-1">Firstname</label>
                                        <input type="text" name="firstname" class="form-control" readonly>
                                        <span class="txt_error text-danger mx-1 firstname_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="mx-1">Lastname</label>
                                        <input type="text" name="lastname" class="form-control" readonly>
                                        <span class="txt_error text-danger mx-1 lastname_error"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="mx-1">Email</label>
                                        <input type="email" name="email" class="form-control" readonly>
                                        <span class="txt_error text-danger mx-1 email_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="mx-1">Contact Number</label>
                                        <input type="text" name="contact_number" class="form-control" readonly>
                                        <span class="txt_error text-danger mx-1 contact_number_error"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="mx-1">Occupation</label>
                                        <input type="text" name="occupation_status" class="form-control" readonly>
                                        <span class="txt_error text-danger mx-1 occupation_status_error"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="mx-1">Unit</label>
                                        <select class="form-select" name="unit_id" disabled>
                                            @foreach ($units as $unit)
                                                <option value={{ $unit->id }}>{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="txt_error text-danger mx-1 unit_id_error"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="mx-1">Start Date</label>
                                        <input type="date" name="start_date" class="form-control" readonly>
                                        <span class="txt_error text-danger mx-1 start_date_error"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="mx-1">End Date</label>
                                        <input type="date" name="end_date" class="form-control" readonly>
                                        <span class="txt_error text-danger mx-1 end_date_error"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="mx-1">Status</label>
                                        <select class="form-select" name="status" disabled>
                                            <option value="3">Paid</option>
                                            <option value="4">Pending Balance</option>
                                            <option value="5">Unpaid Bills</option>
                                        </select>
                                        <span class="txt_error text-danger mx-1 status_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                        
                            </div>
                        </div>
                        <div class="tab-pane fade px-3 mt-3" id="nav-bill" role="tabpanel" aria-labelledby="nav-bill-tab">
                            <table class="table align-items-center" id="bills-content">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            <div class="modal-footer">
                        
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-update" role="tabpanel" aria-labelledby="nav-update-tab">
                            <form action="/editTenant" method="post" id="detailForm" class="editFormModal">
                                @csrf
                                <div class="modal-body">
            
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="mx-1">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" required>
                                            <span class="txt_error text-danger mx-1 firstname_error"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="mx-1">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" required>
                                            <span class="txt_error text-danger mx-1 lastname_error"></span>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="mx-1">Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                            <span class="txt_error text-danger mx-1 email_error"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="mx-1">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control" required>
                                            <span class="txt_error text-danger mx-1 contact_number_error"></span>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="mx-1">Occupation</label>
                                            <input type="text" name="occupation_status" class="form-control" required>
                                            <span class="txt_error text-danger mx-1 occupation_status_error"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="mx-1">Unit</label>
                                            <select class="form-select" name="unit_id" required>
                                                @foreach ($units as $unit)
                                                    <option value={{ $unit->id }}>{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="txt_error text-danger mx-1 unit_id_error"></span>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="mx-1">Start Date</label>
                                            <input type="date" name="start_date" class="form-control" required>
                                            <span class="txt_error text-danger mx-1 start_date_error"></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="mx-1">End Date</label>
                                            <input type="date" name="end_date" class="form-control" required>
                                            <span class="txt_error text-danger mx-1 end_date_error"></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="mx-1">Status</label>
                                            <select class="form-select" name="status" required>
                                                <option value="3">Paid</option>
                                                <option value="4">Pending Balance</option>
                                                <option value="5">Unpaid Bills</option>
                                            </select>
                                            <span class="txt_error text-danger mx-1 status_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End View Details modal --}}

    {{-- Delete modal confirmation --}}
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deleteTenant" method="post" id="delForm" class="delFormModal">
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
@stop
