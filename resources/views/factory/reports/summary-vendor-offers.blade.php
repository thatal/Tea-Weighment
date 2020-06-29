@extends('layouts.app')
@section('title')
Summary Reports
@endsection
@section('p_title')
Summary Reports
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reports</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            {{-- <a href="{{route("factory.offer.index", array_merge(request()->all(), ["export" => "excel"]))}}"
                                target="_blank">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> Export to
                                    Excel</button>
                            </a> --}}
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 60vh;">
                    @include("factory.common.summary-vendor-offers", ["summary_reports" => $summary_reports])
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
