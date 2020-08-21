<h3>{{ $records->count() }} records found.</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Fine Leaf count Range</th>
            <th>Price</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($records as $key => $record)
            <tr class="@if($record->deleted_at) text-danger @endif">
                <td>{{ $key +1 }}</td>
                <td>{{ $record->fine_leaf_count_from }} - {{ $record->fine_leaf_count_to }} %</td>
                <td>{{ $record->price }}</td>
                <td>{{ $record->date }}</td>
                <td>
                    @if( $record->deleted_at)
                        <span class="badge badge-danger">Inactive</span>
                    @else
                        <span class="badge badge-success">Active</span>
                    @endif
                </td>
                <td>
                    <button type="button" onClick="editRecord(this)" data-record='{!! json_encode($record) !!}'
                        data-url="{{ route('factory.fine-leaf.edit', $record) }}"
                        class="btn btn-sm btn-primary">Edit</button>
                        @if($record->deleted_at)

                            <button type="button" onClick="activateRecord(this)"
                                data-url="{{ route('factory.fine-leaf.activate', $record) }}"
                                data-record='{!! json_encode($record) !!}' class="btn btn-sm btn-success">Activate</button>
                        @else
                            <button type="button" onClick="deleteRecord(this)"
                                data-url="{{ route('factory.fine-leaf.destroy', $record) }}"
                                data-record='{!! json_encode($record) !!}' class="btn btn-sm btn-danger">Deactivate</button>

                        @endif
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-danger text-center" colspan="5">No Records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
