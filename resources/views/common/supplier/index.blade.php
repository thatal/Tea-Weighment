<table class="table table-bordered">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Contact No</th>
            <th>Address</th>
            <th>Bank Information</th>
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
            </tr>
        @empty
            <tr>
                <td class="text-center text-danger" colspan="5">No Records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
