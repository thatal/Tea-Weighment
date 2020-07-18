@extends ('layouts.app')
@section ('title')
Headquarter Change Password
@endsection
@section ('p_title')
Change Password
@endsection
@section ('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>

                    <div class="card-tools">
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open(["route" => "headquarter.change-password.post"]) !!}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label("current_password", "Current Password", ["class"=> "control-label"]) !!}
                                {!! Form::password("current_password", ["class" => "form-control ".($errors->has("current_password") ? "is-invalid" : ""),
                                "required" => true,
                                "password" => "current_password", "placeholder" => "Current Password"
                                ]) !!}
                                @error ('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label("password", "Password", ["class"=> "control-label"]) !!}
                                {!! Form::password("password", ["class" => "form-control
                                ".($errors->has("current_password") ? "is-invalid" : "")
                                , "required" => true, "id" =>
                                "password", "placeholder" => "Password"
                                ]) !!}
                                @error ('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label("password_confirmation", "Confirm Password", ["class"=>
                                "control-label"]) !!}
                                {!! Form::password("password_confirmation", ["class" => "form-control "
                                .($errors->has("password_confirmation") ? "is-invalid" : ""), "required" =>
                                true, "id" => "password_confirmation", "placeholder" => "Password Confirmation"
                                ]) !!}
                                @error ('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::submit("Change Password", ["class" => "btn btn-sm btn-primary"]) !!}
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
@section ("js")
@endsection
