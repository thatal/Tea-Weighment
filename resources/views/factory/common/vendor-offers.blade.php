<table class="table table-head-fixed text-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Supplier</th>
            @if(auth()->user()->isHeadquarter())
                <th>Factory</th>
            @endif
            <th>Confirmation</th>
            <th>Qty</th>
            <th>Offer Price</th>
            <th>Exp. Fine leaf count</th>
            <th>Exp. Moisture</th>
            <th>Final Price Added</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($vendor_offers as $key => $offer)
        <tr>
            <td>{{(($vendor_offers->currentPage() - 1 ) * $vendor_offers->perPage() ) + 1 + $key}}</td>
            <td>{{$offer->created_at->format("Y-m-d")}}</td>
            <td>{{$offer->vendor->name ?? "NA"}}</td>
            @if(auth()->user()->isHeadquarter())
                <td>{{$offer->factory->name ?? "NA"}}</td>
            @endif
            <td>{{$offer->confirmation_code ?? "N/A"}}</td>
            <td>{{$offer->leaf_quantity}}</td>
            <td>{{$offer->offer_price}}</td>
            <td>{{$offer->expected_fine_leaf_count}}</td>
            <td>{{$offer->expected_moisture}}</td>
            <td>
                @if ($offer->leaf_count_added_at)
                    <span class="badge badge-success">Yes</span>
                @else
                    <span class="badge badge-danger">No</span>
                @endif
            </td>
            <td>{{ucwords(str_replace("_", " ",$offer->status))}}</td>
            <td>
                @if(auth()->user()->isFactory() || auth()->user()->isHeadquarter())
                    @if (today()->format("Y-m-d") == $offer->created_at->format("Y-m-d") && $offer->status == "pending")
                        @if(auth()->user()->isHeadquarter())
                            <button class="btn btn-primary btn-sm" onClick="return confirm('Are you sure ?')">
                                <a href="{{route("headquarter.offer.accept", $offer->id)}}" style="color:white;">Accept Offer</a>
                            </button>
                        @else
                            <button class="btn btn-primary btn-sm" onClick="return confirm('Are you sure ?')">
                                <a href="{{route("factory.offer.accept", $offer->id)}}" style="color:white;">Accept Offer</a>
                            </button>
                        @endif
                        <button class="btn btn-warning btn-sm"
                            data-url="{{ route('headquarter.counter.offer', $offer) }}"
                            data-offer="{{ json_encode($offer) }}" onClick="counterOffer(this)">
                            Counter Offer
                         </button>
                    @else
                    {{-- <button class="btn btn-primary btn-sm" disabled>
                        Accept Offer
                    </button> --}}
                    @endif
                    @if (auth()->user()->isFactory() && $offer->status == \App\Models\VendorOffer::$second_wieght_status && !$offer->leaf_count_added_at )
                        <button
                        type="button"
                        data-offer='{!!json_encode($offer)!!}'
                        @if(auth()->user()->isFactory())
                            data-url=""
                        @elseif(auth()->user()->isHeadQuarter())
                            data-url='{{route("headquarter.fine-leaf.add-price", $offer)}}'
                        @endif
                        data-offer='{!!json_encode($offer)!!}'
                        class="btn btn-warning btn-sm" onClick="addLeafCountPc(this)"> Add Leaf Count % (Price)</button>
                    @endif
                    @if (in_array($offer->status, ["pending", "confirmed"]))
                        @if(auth()->user()->isHeadquarter())
                            <button class="btn btn-danger btn-sm" onClick="return confirm('Are you sure ?')">
                                <a href="{{route("headquarter.offer.cancel", $offer->id)}}" style="color:white;">Cancel Offer</a>
                            </button>
                        @else
                            <button class="btn btn-danger btn-sm" onClick="return confirm('Are you sure ?')">
                                <a href="{{route("factory.offer.cancel", $offer->id)}}" style="color:white;">Cancel Offer</a>
                            </button>
                        @endif
                    @endif
                    @if($offer->status === \App\Models\VendorOffer::$second_wieght_status)
                        <button class="btn btn-warning btn-sm" type="button" data-url="{{route("factory.offer.incentive", $offer->id)}}" data-offer='{{$offer->toJson()}}' onClick="addIncentive(this)"> Incentive</button>
                    @endif
                @endif
                <button type="button" class="btn btn-success btn-sm" onclick="showDetails(this)" data-offer="{{json_encode($offer)}}"><i
                        class="far fa-eye"></i> View</button>
            </td>
        </tr>

        @empty
        <tr>
            <td class="text-danger text-center" colspan="7">No records found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<!-- Modal  -->
<div class="modal fade" id="vendorOffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vendor Offer Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="table-responsive">

            </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="vendorOfferCounter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Counter Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" onSubmit="return confirm('Are you sure ?');">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="offer_price">Supplier Offer Price</label>
                        <input type="number" id="offer_price" readonly class="form-control" step="00.01" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label for="offer_price">Counter Price</label>
                        <input type="number" id="counter_price" name="counter_price" class="form-control" step="00.01"
                            placeholder="0.00" required>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="vendorAddPrice" tabindex="-1" role="dialog" aria-labelledby="vendorAddPrice"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vendorAddPrice">Add Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5 pl-3 pr-3">
                            {!! Form::open(["method" => "POST"]) !!}
                                <div class="form-group">
                                    {!! Form::label("confirm_leaf_count", "Leaf Count %", ["class" => "label-control"]) !!}
                                    {!! Form::number("leaf_count", null, ["min" => 1, "class" => "form-control input-sm", "required" =>  true, "placeholder" => "%"]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label("price", "Price", ["class" => "label-control"]) !!}
                                    {!! Form::number("price", null, ["min" => 1, "class" => "form-control input-sm", "required" =>  true, "placeholder" => "Price", "step" => "0.01"]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit("Submit", ["class" => "btn btn-sm btn-primary"]) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-sm-7">
                            <h4>Today's Leaf Price.</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fine Leaf Count % range</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Services\CommonService::getTodaysFineLeafPrice() as $index => $item)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>
                                                {{ $item->fine_leaf_count_from }} - {{ $item->fine_leaf_count_to}}
                                            </td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->date}}</td>
                                        </tr>
                                    @empty
                                        <td class="text-danger text-center">No Records found.</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="incentiveModal" tabindex="-1" role="dialog" aria-labelledby="incentiveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="incentiveModalLabel">Incentive <strong id="confirmation_code"></strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(["id" => "incentiveForm", "onSubmit" => "incentiveSubmit(this, event)"]) !!}
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label("Net Weight", "Net Weight (KG)", ["class" => "control-label"]) !!}
                {!! Form::number("net_weight", null, ["id" => "net_weight", "class" => "form-control", "readonly" => true]) !!}
            </div>
            <div class="form-group">
                {!! Form::label("incentive_per_kg", "Incentive Per KG (Rs)", ["class" => "control-label"]) !!}
                {!! Form::number("incentive_per_kg", null, ["id" => "incentive_per_kg", "class" => "form-control", "required" => true]) !!}
            </div>
            <div class="form-group">
                {!! Form::label("total_incentive", "Total Incentive", ["class" => "control-label"]) !!}
                {!! Form::number("total_incentive", null, ["id" => "total_incentive", "class" => "form-control", "required" => true]) !!}
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
