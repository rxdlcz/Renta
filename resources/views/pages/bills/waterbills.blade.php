@extends('pages.manage.navigation')

@section('title', 'Water Bills')
@section('content')

    <div class="content-header">
        <h1 class="">Water Bills</h1>

        <!-- Add User button modal -->
        <button type="button" class="button" data-bs-toggle="modal" data-backdrop="false" data-bs-target="#addModal">
            <span class="button__text">Add Bill</span>
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
                <th>Tenant</th>
                <th>Balance</th>
                <th>Due Date</th>
                <th>Status</th>
                <th class="no-sort text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->tenant->firstname }} {{ $bill->tenant->lastname }}</td>
                    <td>{{ $bill->amount_balance }}</td>
                    <td>{{ $bill->due_date }}</td>
                    <td>{{ $bill->status }}</td>
                    <td><button class='btn bg-info edit ml-2' data-bs-toggle='modal'
                            data-bs-target='#editModal'>Edit</button>
                        <button class='btn bg-info del ml-2' data-bs-toggle='modal'
                            data-bs-target='#deleteModal'>Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Add Water Bill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addWater" method="post" id="addForm" class="addFormModal">
                    @csrf
                    <div class="modal-body mt-3">
                        <label class="mx-1">Tenant</label>
                        <select class="form-select" name="tenant_id">
                            @foreach ($tenants as $tenant)
                                <option value={{ $tenant->id }}>{{ $tenant->firstname }} {{ $tenant->lastname }}
                                </option>
                            @endforeach
                        </select>
                        <span class="txt_error text-danger mx-1 tenant_id_error"></span>

                        <label class="mx-1">Amount</label>
                        <input type="number" name="amount_balance" class="form-control" required>
                        <span class="txt_error text-danger mx-1 amount_balance_error"></span>

                        <label class="mx-1">Due Date</label>
                        <input type="date" name="due_date" class="form-control" id="addDueDate" required>
                        <span class="txt_error text-danger mx-1 due_date_error"></span>

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
                    <h5 class="modal-title">Edit Bills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/editWater" method="post" id="editForm" class="editFormModal">
                    @csrf
                    <div class="modal-body mt-3" id="modalInput">
                        <label class="mx-1">Tenant</label>
                        <select class="form-select" name="tenant_id">
                            @foreach ($tenants as $tenant)
                                <option value={{ $tenant->id }}>{{ $tenant->firstname }} {{ $tenant->lastname }}</option>
                            @endforeach
                        </select>
                        <span class="txt_error text-danger mx-1 tenant_id_error"></span>

                        <label class="mx-1">Amount</label>
                        <input type="number" name="amount_balance" class="form-control" required>
                        <span class="txt_error text-danger mx-1 amount_balance_error"></span>

                        <label class="mx-1">Due Date</label>
                        <input type="date" name="due_date" class="form-control" required>
                        <span class="txt_error text-danger mx-1 due_date_error"></span>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
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
                    <h5 class="modal-title text-white">Delete Bills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deleteBills" method="post" id="delForm" class="delFormModal">
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
        //statusUpdate();
        document.getElementById('addDueDate').value = new Date().toISOString().substring(0, 10);
    </script>
@endsection
