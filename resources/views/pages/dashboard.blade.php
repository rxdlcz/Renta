@extends('pages.manage.navigation')

@section('title', 'Dashboard')
@section('content')

    <h1 class="text-center">
        Dashboard</h1>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Location Count:</h5>
                    <h1 class="card-text text-center">{{ $locations->count() }}</h1>
                </div>
                <a href="/location" class="detail-link">
                    <div class="card-footer text-white more-details">More Details</div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">House Unit Count:</h5>
                    <h1 class="card-text text-center">{{ $units->count() }}</h1>
                </div>
                <a href="/location" class="detail-link">
                    <div class="card-footer text-white more-details">More Details</div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tenant Count:</h5>
                    <h1 class="card-text text-center">{{ $tenants->count() }}</h1>
                </div>
                <a href="/location" class="detail-link">
                    <div class="card-footer text-white more-details">More Details</div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Pending Bills:</h5>
                    <h1 class="card-text text-center">
                    </h1>
                </div>
                <a href="/location" class="detail-link">
                    <div class="card-footer text-white more-details">More Details</div>
                </a>
            </div>
        </div>
    </div>
@stop
