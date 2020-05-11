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
                <h3 class="card-title">Vehicles list</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        {{-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> --}}

                        <a href="{{route("admin.vehicle.create")}}"><button type="button" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i> Add New</button></a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 60vh;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Weight</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles as $k => $vehicle)
                            <tr>
                                <td>{{(($vehicles->currentPage() - 1 ) * $vehicles->perPage() ) + 1 + $k}}</td>
                                <td>{{$vehicle->name}}</td>
                                <td>{{$vehicle->weight}}</td>
                                <td>
                                <a href="{{route("admin.vehicle.destroy", $vehicle)}}" onClick="return confirm('Are you sure ?')">
                                    <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-container="body" data-title="Delete"> <i class="fas fa-trash"></i></button>
                                </a>
                                <a href="{{route("admin.vehicle.edit", $vehicle)}}">
                                    <button class="btn btn-sm btn-primary" data-toggle="tooltip" data-container="body" data-title="Edit"> <i class="fas fa-edit"></i></button>
                                </a>
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
                {!! $vehicles->appends(request()->all())->links()!!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->
</div>
@endsection
