<div>
    <table cellpadding="5" class="table display expandable-table table-responsive-sm" style="width:100%;">
        <thead>
            <tr>
                <th width="300px">No. Tables</th>
                <th width="500px">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <th>{{ $customer->no_table }}</th>
                    <td>
                        @if ($customer->status === 'Free')
                            <div class="badge badge-success">{{ $customer->status }}
                            </div>
                        @else
                            <div class="badge badge-warning">{{ $customer->status }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div>
                            <a href="{{ route('print.table', $customer->id) }}" class="btn btn-info btn-md text-white"
                                style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                    class="ti-printer"></i> Print</a>
                            @if (Auth::user()->hasRole('manager'))
                            <a href="{{ route('tables.edit', $customer->id) }}" class="btn btn-primary btn-md text-white"
                                style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                    class="ti-pencil"></i> Edit</a>
                                <button wire:click.prevent="removeItem({{ $customer->id }});" type="submit"
                                    class="btn btn-danger btn-sm" style="height:40px"><i
                                        class="ti-trash"></i> Delete</button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
