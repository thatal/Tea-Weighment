@extends('layouts.app')
@section('title')
Vendor Offers
@endsection
@section('p_title')
Vendor Offers
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
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    {!! Form::label("date_from", "Date from", ["class" => "label-control"]) !!}
                                    {!! Form::date("date_from", request("date_from"), ["class" => "form-control", "id" => "date_from"]) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    {!! Form::label("date_to", "Date to", ["class" => "label-control"]) !!}
                                    {!! Form::date("date_to", request("date_to"), ["class" => "form-control", "id" => "date_to"]) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    @php
                                        $vendor_array = \App\Services\CommonService::vendor_array($for_dropdown = true);
                                    @endphp
                                    {!! Form::label("vendor", "Vendor", ["class" => "label-control"]) !!}
                                    {!! Form::select("vendor", $vendor_array, request("vendor"), ["class" => "form-control"]) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    @php
                                        $status = ["" => "All"] +  \App\Models\VendorOffer::$status;
                                    @endphp
                                    {!! Form::label("offer_status", "Offer Status", ["class" => "label-control"]) !!}
                                    {!! Form::select("offer_status", $status, request("offer_status"), ["class" => "form-control"]) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                {!! Form::button("<i class='fa far fa-filter'></i> Search", ["class" => "btn btn-primary btn-sm", "type" => "submit"], false) !!}
                                <button class="btn btn-sm btn-danger ml-2"> Reset</button>
                            </div>
                        </div>
                    {{-- </div> --}}
                    {!! Form::close() !!}
                </div>
            </div>
            {{-- end of filters --}}
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Vendor Offers</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <a href="{{route("factory.offer.index", array_merge(request()->all(), ["export" => "excel"]))}}" target="_blank">
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
@endsection
