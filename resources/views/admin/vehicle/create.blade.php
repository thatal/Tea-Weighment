@extends('layouts.app')
@section('title')
Admin Vehicles
@endsection
@section('p_title')
Vehicles
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New Vehicle</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            {{-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> --}}

                            <a href="{{route("admin.vehicle.index")}}"><button type="button"
                                    class="btn btn-primary btn-flat"><i class="fas fa-list-alt"></i> View all</button></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body pl-3">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::open([
                                "route" => "admin.vehicle.store",
                                "method" => "post",
                                "id" => "vehicle-form"
                            ]) !!}
                            @include("admin.vehicle.form")
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
