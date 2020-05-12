@extends('layouts.app')
@section('title')
Admin Factories
@endsection
@section('p_title')
Factories
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Factory list</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            {{-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> --}}

                            <a href="{{route("headquarter.factory.create")}}"><button type="button"
                                    class="btn btn-primary btn-flat"><i class="fas fa-plus"></i> Add New</button></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 60vh;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($factories as $k => $factory )
                            <tr>
                                <td>{{(($factories->currentPage() - 1 ) * $factories->perPage() ) + 1 + $k}}</td>
                                <td>{{$factory->username}}</td>
                                <td>{{$factory->name}}</td>
                                <td>{{$factory->factory_information->mobile}}</td>
                                <td>{{$factory->email}}</td>
                            <td><span class="badge badge-{{$factory->factory_information->is_available ? "success" : "danger"}}">{{$factory->factory_information->is_available ? "Available" : "No Available"}}</span></td>
                                <td>
                                    <a href="{{route("headquarter.factory.destroy", $factory)}}"
                                        onClick="return confirm('Are you sure ?')">
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                            data-title="Delete"><i class="fas fa-trash"></i></button>
                                    </a>
                                    <a href="{{route("headquarter.factory.edit", $factory)}}">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                            data-title="Edit"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{route("headquarter.factory.show", $factory)}}" class="ajax-view">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                            data-title="View Details"><i class="fas fa-eye"></i></button>
                                    </a>
                                    <a href="{{route("headquarter.factory.reset", $factory)}}" class="ajax-password">
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                            data-title="Reset password"><i class="fas fa-key"></i></button>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-danger text-center" colspan="5">No records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $factories->appends(request()->all())->links()!!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="viewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">factory details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true" id="paswordReset">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

@endsection
@section("js")
<script>
    $(document).ready(function(){
            $(".ajax-view").on("click", function(e){
                e.preventDefault();
                var url = $(this).prop("href");
                var xhr = $.get(url);
                xhr.done(function(response){
                    var modal = $("#viewModal");
                    modal.find(".modal-body").html(response);
                    modal.modal();
                });
                xhr.fail(function(response){
                    toastr.error("Data loading failed.");
               });
            });
            $(".ajax-password").on("click", function(e){
                e.preventDefault();
                if(!confirm("Are you sure ?")){
                    return false;
                }
                var url = $(this).prop("href");
                var xhr2 = $.get(url);
                xhr2.done(function(response){
                    var modal = $("#paswordReset");
                    modal.find(".modal-body").html(response.message);
                    modal.modal();
                });
                xhr2.fail(function(response){
                    toastr.error("Whoops! something went wrong.");
               });
            });
        });
</script>
@endsection
