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
                        <label for="offer_price">Offer Price</label>
                        <input type="number" id="offer_price" readonly class="form-control" step="00.01" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label for="offer_price">Accept Price</label>
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
