@foreach ($errors->all() as $error)
<li class="text-danger">{{ $error }}</li>
@endforeach
<div class="form-group">
    {!! Form::label("name", "Vehicle Type", ["class" => "label-control"]) !!}
    {!! Form::text("name", null, ["class" => "form-control input-sm", "required" => true, "max" => "100", "placeholder"
    => "Vehicle Name"]) !!}
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label("weight", "Weight (kg)", ["class" => "label-control"]) !!}
    {!! Form::number("weight", null, ["class" => "form-control input-sm ", "required" => true, "maxlength" => "20",
    "placeholder" => "Vehicle Weight", "step" => "0.100"]) !!}
    @error('weight')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
