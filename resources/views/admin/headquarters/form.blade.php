<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label("name", "Name", ["class" => "label-control"]) !!}
            {!! Form::text("name", null, ["class" => "form-control input-sm", "required" => true, "max" => "100",
            "placeholder"
            => "Name"]) !!}
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label("code", "Code", ["class" => "label-control"]) !!}
            {!! Form::text("code", $headquarter->username ?? null, ["class" => "form-control input-sm ", "required" => true, "maxlength" => "20",
            "placeholder" => "code", "disabled" => isset($headquarter) ? true : false]) !!}
            @error('code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label("email", "Email", ["class" => "label-control"]) !!}
            {!! Form::email("email", null, ["class" => "form-control input-sm ", "required" => true, "maxlength" => "50",
            "placeholder" => "email"]) !!}
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @if(!isset($headquarter))
        <div class="form-group">
            {!! Form::label("password", "Password", ["class" => "label-control"]) !!}
            {!! Form::password("password", ["class" => "form-control input-sm ", "required" => true, "maxlength" => "50",
            "placeholder" => "password"]) !!}
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @endif
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label("address_1", "Address Line 1", ["class" => "label-control"]) !!}
            {!! Form::text("address_1", $headquarter->address->address_1 ?? null, ["class" => "form-control input-sm ", "required" => true, "maxlength" => "255",
            "placeholder" => "Address line 1"]) !!}
            @error('address_1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label("address_2", "Address Line 2", ["class" => "label-control"]) !!}
            {!! Form::text("address_2", $headquarter->address->address_2 ?? null, ["class" => "form-control input-sm ", "required" => true, "maxlength" => "255",
            "placeholder" => "Address line 2"]) !!}
            @error('address_2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label("pin", "Pin", ["class" => "label-control"]) !!}
            {!! Form::number("pin", $headquarter->address->pin ?? null, ["class" => "form-control input-sm ", "required" => true, "maxlength" => "7", "size" => 7,
            "placeholder" => "Pin"]) !!}
            @error('pin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @if(!isset($headquarter))
            <div class="form-group">

                <button type="button" class="btn btn-primary btn-sm link-password" id="generate">Generate Password</button>
                <button type="button" class="btn btn-success btn-sm link-password" id="confirm">Use Password</button>
                <input type="text" id="random" class="form-control" placeholder="random password">

            </div>
        @endif

    </div>
</div>
