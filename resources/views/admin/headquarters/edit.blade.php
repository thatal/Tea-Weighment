@extends('layouts.app')
@section('title')
Admin Headquarters
@endsection
@section('p_title')
Headquarter
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Headquarter</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            {{-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> --}}

                            <a href="{{route("admin.headquarter.index")}}"><button type="button"
                                    class="btn btn-primary btn-flat"><i class="fas fa-list-alt"></i> View
                                    all</button></a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body pl-3">
                    {!! Form::model($headquarter, [
                    "route" => ["admin.headquarter.update", $headquarter],
                    "method" => "post",
                    "id" => "headquarter-form"
                    ]) !!}
                    @method("PATCH")
                    @include("admin.headquarters.form")
                    <div class="row">
                        <div class="col-sm-5">
                            @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
@section('js')
<script>
    $.extend({
        password: function (length, special) {
            var iteration = 0;
            var password = "";
            var randomNumber;
            if(special == undefined){
                var special = false;
            }
            while(iteration < length){
                randomNumber=(Math.floor((Math.random() * 100)) % 94) + 33;
                if(!special){
                    if ((randomNumber>=33) && (randomNumber <=47)) {
                        continue;
                    }
                    if ((randomNumber>=58) && (randomNumber <=64)) {
                        continue;
                    }
                    if ((randomNumber>=91) && (randomNumber <=96)) {
                        continue;
                    }
                    if ((randomNumber>=123) && (randomNumber <=126)) {
                        continue;
                    }
                }
                iteration++; password +=String.fromCharCode(randomNumber);
            }
            return password;
        }
    });
    $(document).ready(function() {
        $('.link-password').click(function(e){
            linkId = $(this).attr('id');
            if (linkId == 'generate'){
                password = $.password(12,true);
                console.log("password");
                $('#random').hide().val(password).fadeIn('slow');
                $('#confirm').fadeIn('slow');
            } else {
                $('#password').val(password);
                $('#random').val("");
                $(this).hide();
            }
            e.preventDefault();
        });
    });
</script>
@endsection
