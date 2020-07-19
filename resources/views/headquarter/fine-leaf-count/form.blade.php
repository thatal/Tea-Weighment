<div class="form-group">
    {!! Form::label("leaf_count", "Leaf Count % range", ["class" => "control-label"]) !!}
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <div class="input-group-text">From</div>
        </div>
        {!! Form::number("leaf_count_from", null, ["class" =>
        "form-control".($errors->has('leaf_count_from') ? " is-invalid" : " "), "required"
        =>
        true,
        "placeholder" => "%", "step" => "0.01"]) !!}
        <div class="input-group-prepend">
            <div class="input-group-text">To</div>
        </div>
        {!! Form::number("leaf_count_to", null, ["class" =>
        "form-control".($errors->has('leaf_count_to') ? " is-invalid" : " "), "required"
        => true,
        "placeholder" => "%", "step" => "0.01"]) !!}
    </div>
    @error ('leaf_count_from')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    @error ('leaf_count_to')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    {!! Form::label("price", "Price", ["class" => "control-label"]) !!}
    {!! Form::number("price", null, ["class" => "form-control".($errors->has('price') ? "
    is-invalid" : " "), "required" => true,
    "placeholder" => "Price", "step" => "0.01"]) !!}
    @error ('leaf_count')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    {!! Form::label("leaf_count", "Date", ["class" => "control-label"]) !!}
    {!! Form::date("date", null, ["class" => "form-control".($errors->has('date') ? "
    is-invalid" : " "),
    "required" => true,
    "placeholder" => "date"]) !!}
    @error ('leaf_count')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    {!! Form::submit("Submit", ["class" => "btn btn-sm btn-primary"]) !!}
</div>
