@extends('layout.navigation')

@section('title', 'Dashboard')
@section('content')

    <h1 class="text-center">
        Dashboard</h1>
    <hr>
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="img/icon/location.png" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Location</h6>
                                    <h6 class="font-extrabold mb-0">{{ $locations->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="img/icon/unit.png" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Units</h6>
                                    <h6 class="font-extrabold mb-0">{{ $units->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="img/icon/tenant.png" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Tenants</h6>
                                    <h6 class="font-extrabold mb-0">{{ $tenants->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="img/icon/bill.png" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Bills</h6>
                                    <h6 class="font-extrabold mb-0">{{ $bills }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <span>
                                    <img src="img/icon/addPayment.png" alt="" width="32" height="32">
                                </span>
                                <h4 class="mx-2">Add Payment</h4>
                            </div>
                        </div>
                        <div class="card-body align-items-center d-flex justify-content-center">
                            <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#addModal">
                                <span class="button__text">Add Payment</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8 mt-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex">
                                <span>
                                    <img src="img/icon/payment.png" alt="" width="38" height="38">
                                </span>
                                <h4 class="mx-3">Latest Payment</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->tenant->firstname }}</td>
                                                <td>{{ $payment->tenant_id }}</td>
                                                <td>{{ $payment->bill->bill_type }}</td>
                                                <td>{{ $payment->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card" data-bs-toggle="modal" data-bs-target="#ProfileModal" style="cursor: pointer;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="img/adminImg/{{ $data->profImg }}" alt="">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ $data->firstname }} {{ $data->lastname }}</h5>
                            <h6 class="text-muted mb-0">{{ $data->email }}</h6>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex">
                        <span>
                            <img src="img/icon/userKey.png" alt="" width="32" height="32">
                        </span>
                        <h4 class="mx-3">User</h4>
                    </div>
                </div>
                <div class="card-content pb-4">
                    @foreach ($users as $user)
                        @if ($loop->iteration <= 3)
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="img/adminImg/{{ $user->profImg }}">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">{{ $user->firstname }} {{ $user->lastname }}</h5>
                                    <h6 class="text-muted mb-0">{{ $user->email }}</h6>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <a href="/user" class="text-decoration-none">
                        <div class="px-4 align-items-center d-flex justify-content-center">
                            <button type="btn" class="btn btn-info form-control">
                                View More...
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addUnit" method="post" id="addForm" class="addFormModal">
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
                                <span class="txt_error text-danger mx-1 name_error"></span>

                                <label class="mx-1">House Unit</label>
                                <select class="form-select" name="unit_id" disabled>
                                    @foreach ($units as $unit)
                                        <option value={{ $unit->id }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                <span class="txt_error text-danger mx-1 location_id_error"></span>

                                <label class="mx-1">Type</label>
                                <input type="text" name="bill_type" class="form-control" readonly>
                                <span class="txt_error text-danger mx-1 price_error"></span>

                                <label class="mx-1">Amount</label>
                                <input type="number" name="amount" class="form-control" readonly>
                                <span class="txt_error text-danger mx-1 price_error"></span>
                            </div>
                            <div class="col-sm-8">
                                <label class="mx-1">Choose Bill</label>
                                <table class="table table-hover" id="select_bill">
                                    <thead>
                                        <tr>
                                            <th>Unit</th>
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
    {{-- End Add Modal --}}

@stop

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
                "searching": false
            });
            $('#select_bill tbody').on('click', 'tr', function() {
                $('#select_bill > tbody  > tr').each(function(index) {
                    $(this).removeClass('table-active');
                });
                $(this).addClass('table-active');

                var unit = $(this).find('td:eq(0)').text();
                var type = $(this).find('td:eq(1)').text();
                var amount = $(this).find('td:eq(2)').text();
                //console.log(parent_id);

                $('.addFormModal input[name=unit_id]').val(unit);
                $('.addFormModal input[name=bill_type]').val(type);
                $('.addFormModal input[name=amount]').val(amount);
            })

        });



        $("#paymentName_select").change(function() {
            console.log($('#paymentName_select :selected').val());

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
                        "searching": false
                    });
                    //add value to bills tab
                    $.each(response.bill, function(key, item) {
                        sbill.dataTable().fnAddData([
                            item.id,
                            item.bill_type,
                            item.amount_balance,
                        ]);
                    });


                }
            });
        });
    </script>
@endsection
