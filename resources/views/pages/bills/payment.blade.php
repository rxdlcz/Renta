@extends('layout.navigation')

@section('title', 'Payment')
@section('content')

    <div class="content-header">
        <div class="d-flex">
            <span>
                <img src="img/icon/payment.png" alt="">
            </span>
            <h1 class="mx-3">Payment</h1>
        </div>

        <!-- Add User button modal -->
        <button type="button" class="button" data-bs-toggle="modal" data-backdrop="false" data-bs-target="#addModal">
            <span class="button__text">Add Payment</span>
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
    <table class="table table-hover table-lg" id="table-content">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date of Payment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    {{-- Add payment Modal --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addPayment" method="post" id="addForm" class="addFormModal">
                    @csrf
                    <div class="modal-body mt-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="mx-1">Tenant</label>
                                <select class="form-select" name="tenant_id" id="paymentName_select" required>
                                    {{-- <option value="">San jose</option> --}}
                                    @foreach ($tenants as $tenant)
                                        <option value={{ $tenant->id }}>{{ $tenant->firstname }}
                                            {{ $tenant->lastname }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="txt_error text-danger mx-1 tenant_id_error"></span>

                                <label class="mx-1">House Unit</label>
                                <select class="form-select" name="unit_id" disabled>
                                    @foreach ($units as $unit)
                                        <option value={{ $unit->id }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                <span class="txt_error text-danger mx-1 unit_id_error"></span>

                                <input type="hidden" name="bill_id" value="">
                                <label class="mx-1">Type</label>
                                <input type="text" name="bill_type" class="form-control" readonly>
                                <span class="txt_error text-danger mx-1 bill_id_error"></span>

                                <label class="mx-1">Amount</label>
                                <input type="number" name="amount" class="form-control" readonly>
                                <span class="txt_error text-danger mx-1 amount_error"></span>
                            </div>
                            <div class="col-sm-8">
                                <label class="mx-1">Choose Bill</label>
                                <table class="table table-hover" id="select_bill">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add payment Modal --}}

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Rent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/editRent" method="post" id="editForm" class="editFormModal">
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
                    <h5 class="modal-title text-white">Delete Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deletePayment" method="post" id="delForm" class="delFormModal">
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
        $('select').val('');
        var sbill;
        $(document).ready(function() {
            sbill = $('#select_bill').dataTable({
                "scrollY": "150px",
                "scrollCollapse": true,
                "paging": false,
                "scrollX": true,
                "scroller": true,
                "searching": false,
            });
            $('#select_bill tbody').on('click', 'tr', function() {
                $('#select_bill > tbody  > tr').each(function(index) {
                    $(this).removeClass('table-active');
                });
                $(this).addClass('table-active');

                var bill_id = $(this).find('td:eq(0)').text();
                var type = $(this).find('td:eq(1)').text();
                var amount = $(this).find('td:eq(2)').text();
                //console.log(parent_id);

                $('.addFormModal input[name=bill_id]').val(bill_id);
                $('.addFormModal input[name=bill_type]').val(type);
                $('.addFormModal input[name=amount]').val(amount);
            })

        });



        $("#paymentName_select").change(function() {
            console.log($('#paymentName_select :selected').val());

            $('.addFormModal input[name=bill_type], input[name=amount], select[name=unit_id]').val('');

            var fetchURL = '/getBillDetails/' + $('#paymentName_select :selected').val();

            $.ajax({
                type: "GET",
                url: fetchURL,
                dataType: "json",
                beforeSend: function() {
                    sbill.dataTable().fnClearTable();
                    sbill.dataTable().fnDraw();
                    sbill.dataTable().fnDestroy();
                },
                success: function(response) {
                    console.log(response);

                    sbill = $('#select_bill').dataTable({
                        "scrollY": "150px",
                        "scrollCollapse": true,
                        "paging": false,
                        "scrollX": true,
                        "scroller": true,
                        "searching": false,
                    });
                    //add value to bills tab
                    $.each(response.bills, function(key, item) {
                        if (item.status != 3) {
                            sbill.dataTable().fnAddData([
                                item.id,
                                item.bill_type,
                                item.amount_balance,
                            ]);
                        }
                    });
                    $('.addFormModal select[name=unit_id]').val(response.tenants.unit_id);

                }
            });
        });
    </script>
@endsection
