@extends('pages.manage.navigation')

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
                            <h4>Add Payment</h4>
                        </div>
                        <div class="card-body align-items-center d-flex justify-content-center">
                            <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#addModal">
                                <span class="button__text">Add Payment</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Payment</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->tenant_id }}</td>
                                                <td>{{ $payment->tenant_id }}</td>
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
            <div class="card" data-bs-toggle="modal" data-bs-target="#ProfileModal">
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
                    <h4>Users</h4>
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
                    <div class="px-4 align-items-center d-flex justify-content-center">
                        <button type="btn" class="btn btn-info form-control">
                            View More...
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

@stop
