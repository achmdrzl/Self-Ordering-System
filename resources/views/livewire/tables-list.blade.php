<div>
    <table cellpadding="5" class="table display expandable-table table-responsive-sm" style="width:100%;">
        <thead>
            <tr>
                <th>No. Tables</th>
                <th>Status</th>
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
                            <a href="{{ route('tables.show', $customer->id) }}" class="btn btn-info btn-md text-white"
                                style="width: 50px; height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                    class="ti-printer"></i></a>
                            {{-- <form onclick="return confirm('are you sure?')"
                            action="{{ route('tables.destroy', $customer->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-md" style="width: 50px; height:40px"><i
                                    class="ti-trash"></i></button>
                        </form> --}}
                            <button wire:click="removeItem({{ $customer->id }});" type="submit"
                                class="btn btn-danger btn-sm" style="width: 50px; height:40px"><i
                                    class="ti-trash"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
