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
                    <th><div class="badge badge-dark">{{ $customer->no_table }}</div></th>
                    <td>
                        @if ($customer->status === 'Free')
                            <div class="badge badge-success">{{ $customer->status }}
                            </div>
                        @elseif($customer->status === 'Unactive')
                            <div class="badge badge-danger">{{ $customer->status }}
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
                                <a href="{{ route('tables.edit', $customer->id) }}"
                                    class="btn btn-primary btn-md text-white"
                                    style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                        class="ti-pencil"></i> Edit</a>
                                @if ($customer->status == 'Unactive')
                                    <button wire:click.prevent="showItem({{ $customer->id }});" type="submit"
                                        class="btn btn-success btn-sm" style="height:40px"><i class="ti-cloud-up"></i>
                                        Show</button>
                                @else
                                    <button wire:click.prevent="removeItem({{ $customer->id }});" type="submit"
                                        class="btn btn-danger btn-sm" style="height:40px"><i class="ti-cloud-down"></i>
                                        Archive</button>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
