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
                    <span class="info-box-text">Vendors</span>
                    <span class="info-box-number">13,648</span>
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
                    <span class="info-box-number">93,139</span>
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
            <h3 class="card-title">Today's pending offers. <small>{{$daily_collections->total()}} records found.</small></h3>

            <div class="card-tools">
                {{-- <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vendor</th>
                        <th>Qty</th>
                        <th>Offer Price</th>
                        <th>Exp. Fine leaf count</th>
                        <th>Exp. Moisture</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($daily_collections as $key => $offer)
                        <tr>
                            <td>{{(($daily_collections->currentPage() - 1 ) * $daily_collections->perPage() ) + 1 + $key}}</td>
                            <td>{{$offer->vendor->name}}</td>
                            <td>{{$offer->leaf_quantity}}</td>
                            <td>{{$offer->offer_price}}</td>
                            <td>{{$offer->expected_fine_leaf_count}}</td>
                            <td>{{$offer->expected_moisture}}</td>
                            <td>{{$offer->status}}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" onClick="return confirm('Are you sure ?')">
                                    <a href="{{route("factory.offer.accept", $offer->id)}}" style="color:white;">Accept Offer</a>
                                </button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td class="text-danger text-center" colspan="7">No records found.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        {!!$daily_collections->links()!!}
    </div>
</div>
@endsection
