<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label("date_from", "Date from", ["class" => "label-control"]) !!}
            {!! Form::date("date_from", request("date_from"), ["class" => "form-control", "id" => "date_from"]) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label("date_to", "Date to", ["class" => "label-control"]) !!}
            {!! Form::date("date_to", request("date_to"), ["class" => "form-control", "id" => "date_to"]) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @php
            $vendor_array = \App\Services\CommonService::vendor_array($for_dropdown = true);
            @endphp
            {!! Form::label("vendor", "Vendor", ["class" => "label-control"]) !!}
            {!! Form::select("vendor", $vendor_array, request("vendor"), ["class" => "form-control"]) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @php
            $status = ["" => "All"] + \App\Models\VendorOffer::$status;
            @endphp
            {!! Form::label("offer_status", "Offer Status", ["class" => "label-control"]) !!}
            {!! Form::select("offer_status", $status, request("offer_status"), ["class" => "form-control"]) !!}
        </div>
    </div>
    <div class="col-sm-3">
        {!! Form::button("<i class='fa far fa-filter'></i> Search", ["class" => "btn btn-primary btn-sm", "type" =>
        "submit"], false) !!}
        <button class="btn btn-sm btn-danger ml-2"> Reset</button>
    </div>

</div>
