<table class="table table-head-fixed text-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Vendor</th>
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
            <td>{{$offer->vendor->name}}</td>
            <td>{{$offer->leaf_quantity}}</td>
            <td>{{$offer->offer_price}}</td>
            <td>{{$offer->expected_fine_leaf_count}}</td>
            <td>{{$offer->expected_moisture}}</td>
            <td>{{$offer->status}}</td>
            <td>
                @if(auth()->user()->isFactory())
                    @if (today()->format("Y-m-d") == $offer->created_at->format("Y-m-d") && $offer->status == "pending")
                    <button class="btn btn-danger btn-sm" onClick="return confirm('Are you sure ?')">
                        <a href="{{route("factory.offer.accept", $offer->id)}}" style="color:white;">Accept Offer</a>
                    </button>
                    @else
                    <button class="btn btn-danger btn-sm" disabled>
                        Accept Offer
                    </button>
                    @endif
                @endif
            </td>
        </tr>

        @empty
        <tr>
            <td class="text-danger text-center" colspan="7">No records found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
