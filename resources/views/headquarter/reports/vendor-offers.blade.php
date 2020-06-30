@extends('layouts.app')
@section('title')
Supplier Offers
@endsection
@section('p_title')
Supplier Offers
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            {{-- filters --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class='fa far fa-filter'></i> Filters</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open(["method" => "GET"]) !!}
                    {{-- <div class="container"> --}}
                        @include("factory.common.filter")
                    {{-- </div> --}}
                    {!! Form::close() !!}
                </div>
            </div>
            {{-- end of filters --}}
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Supplier Offers</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{route("headquarter.offer.index", array_merge(request()->all(), ["export" => "excel"]))}}" target="_blank">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> Export to Excel</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 60vh;">
                    @include("factory.common.vendor-offers", ["vendor_offers" => $vendor_offers])
                    {!!$vendor_offers->appends(request("all"))->links()!!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>

@endsection
@section("js")
    @include('factory.common.js')
@endsection
