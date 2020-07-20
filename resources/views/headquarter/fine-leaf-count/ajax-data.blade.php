<h3>{{ $records->count() }} records found.</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Fine Leaf count Range</th>
            <th>Price</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($records as $key => $record)
            <tr>
                <td>{{ $key +1 }}</td>
                <td>{{ $record->fine_leaf_count_from }} - {{ $record->fine_leaf_count_to }}</td>
                <td>{{ $record->price }}</td>
                <td>{{ $record->date }}</td>
                <td>
                    <button type="button" onClick="editRecord(this)" data-record='{!! json_encode($record) !!}'
                        data-url="{{ route('headquarter.fine-leaf.edit', $record) }}"
                        class="btn btn-sm btn-primary">Edit</button>
                    <button type="button" onClick="deleteRecord(this)"
                        data-url="{{ route('headquarter.fine-leaf.destroy', $record) }}"
                        data-record='{!! json_encode($record) !!}' class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-danger text-center" colspan="5">No Records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
