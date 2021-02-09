<table class="table table-bordered">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Contact No</th>
            <th>Address</th>
            <th>Bank Information</th>
            <th>Slab Show Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($suppliers as $key => $supplier)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$supplier->name}}</td>
                <td>{{$supplier->vendor_information->mobile}}</td>
                <td>
                    {{$supplier->address->address_1 ?? ""}},<br />
                    {{$supplier->address->address_2 ?? ""}},<br />
                    {{$supplier->address->pin ?? ""}}<br />
                </td>
                <td>
                   AC Holder Name: {{$supplier->bank_details->last()->account_holder_name ?? ""}},<br />
                    Bank Name: {{$supplier->bank_details->last()->bank_name ?? ""}},<br />
                    AC No: {{$supplier->bank_details->last()->account_number ?? ""}},<br />
                    IFSC: {{$supplier->bank_details->last()->ifsc_code ?? ""}},<br />
                </td>
                <td>
                    @if($supplier->show_slab)
                        <span class="badge badge-success">Allowed</span>
                    @else
                        <span class="badge badge-danger">Not Allowed</span>
                    @endif
                    @if(auth()->user()->isHeadquarter())
                        <button class="btn btn-primary btn-sm" data-url="{{route("headquarter.vendor.change-status", $supplier->id)}}" onClick="changeSlabStatus(this)">Change Status</button>
                    @else
                        <button class="btn btn-primary btn-sm" data-url="{{route("factory.vendor.change-status", $supplier->id)}}" onClick="changeSlabStatus(this)">Change Status</button>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center text-danger" colspan="5">No Records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Are you sure?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST" onSubmit="return confirm('Are you sure?');">
            @csrf
            <div class="modal-body">
                <p>
                    Your status will change ?
                </p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">Proceed</button>
            </div>
        </form>
    </div>
    </div>
</div>
@section('js')
    <script>
        changeSlabStatus = function(obj){
            var $this = $(obj);
            console.log($this);
            var $modal = $("#exampleModal");
            $modal.find("form").attr("action", $this.data("url"));
            $modal.modal();
        }
    </script>
@endsection
