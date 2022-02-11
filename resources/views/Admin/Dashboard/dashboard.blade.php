@extends('Admin.Layouts.master')

@section('content')

<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{route('admin.dashboard')}}">
                    <li class="breadcrumb-item active">Dashboard</li>
                </a>
            </ol>
        </div>
        <h5 class="page-title">Dashboard</h5>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-cube-outline float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Total Book</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                    <span class="badge badge-success"></span>
                    <h2>{{$books->count()}}</h2>
                </div>
                <div class="mt-4 text-muted">
                    <div class="float-right">
                    </div>
                    <h5 class="m-0"></i></h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-account-network float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Total Bokk Issue</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                    <span class="badge badge-success"></span>
                    <h2>{{$bookissue->count()}}</h2>
                </div>
                <div class="mt-4 text-muted">
                    <div class="float-right">
                        <p class="m-0"></p>
                    </div>
                    <h5 class="m-0"></h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-tag-text-outline float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Avealable Book</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">

                    <span class="badge badge-danger"></span>
                    <h2>{{$avalablebook->count()}}</h2>
                </div>
                <div class="mt-4 text-muted">

                    <h5 class="m-0"></h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-cart-outline float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Total Issue Book</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                    <span class="badge badge-success"></span>
                    <h2>{{$issuedbook->count()}}</h2>
                </div>
                <div class="mt-4 text-muted">

                    <h5 class="m-0"></h5>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection