@extends('layouts.app')
@section('title')
Admin Dashboard
@endsection
@section('p_title')
Dashboard
@endsection
@section('content')
<div class="container-fluid">
    {{-- <h5 class="mb-2">Info Box</h5> --}}
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-tractor"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Suppliers</span>
                    <span class="info-box-number"><a href="{{route("factory.vendor.index")}}">{{\App\Models\Vendor::globalFilter()->count()}}</a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-chart-bar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Today Collections</span>
                    <span class="info-box-number">{{number_format(\App\Services\VendorOfferService::todaysCollection(), 2)}} KG</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Today's offers. <small>{{$daily_collections->total()}} records found.</small></h3>

            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <a href="{{route("factory.offer.index")}}" >
                        <button class="btn btn-primary btn-sm"> View All</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
            @include("factory.common.vendor-offers", ["vendor_offers" => $daily_collections])
        </div>
        {!!$daily_collections->links()!!}
    </div>
</div>
@endsection

@section('js')
    @include('factory.common.js')
@endsection
