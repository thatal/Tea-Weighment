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
                    <span class="info-box-icon bg-info"><i class="far fa-building"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Headquarters</span>
                        <span class="info-box-number">{{
                            \App\Models\Headquarter::count();
                        }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-industry"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Factories</span>
                        <span class="info-box-number">{{
                            \App\Models\Factory::count();
                        }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-tractor"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Suppliers</span>
                        <span class="info-box-number">{{
                            \App\Models\Vendor::count();
                        }}</span>
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
    </div>
@endsection
