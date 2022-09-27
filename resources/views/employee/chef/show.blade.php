    @extends('layouts.employee')

    @push('style-alt')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
            crossorigin="anonymous"></script>
    @endpush

    @section('content')
        @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                {{-- <p class="card-title">Detail Order : <span>{{$orders->table_id}}</span></p> --}}
                                                <table class="table table-hover mb-4">
                                                    {{-- @foreach ($orders as $order) --}}
                                                    <tr>
                                                        <th>No Table</th>
                                                        <th colspan="6">{{ $orders->table_id }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Date</th>
                                                        <td colspan="6">{{ $orders->invoice->order_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Method</th>
                                                        <td colspan="6">{{ strtoupper($orders->invoice->payMethod) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total</th>
                                                        <td colspan="6">Rp.
                                                            {{ number_format($orders->invoice->total) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Order</th>
                                                        <td colspan="6">
                                                            @if ($orders->status_order === 'Cooked')
                                                                <div class="badge badge-warning" style="font-weight: bold">
                                                                    {{ $orders->status_order }}
                                                                </div>
                                                            @elseif($orders->status_order === 'Waiting')
                                                                <div class="badge badge-danger" style="font-weight: bold">
                                                                    {{ $orders->status_order }}
                                                                </div>
                                                            @elseif($orders->status_order === 'On the Way')
                                                                <div class="badge badge-info" style="font-weight: bold">
                                                                    {{ $orders->status_order }}
                                                                </div>
                                                            @else
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    {{-- @endforeach --}}
                                                </table>
                                                <table class="table mb-4 display expandable-table table-responsive-md">
                                                    <thead>
                                                        <th>No</th>
                                                        <th>Menu Order</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($pro as $order)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $order->products->name_product }}</td>
                                                                <td>{{ $order->quantity }}</td>
                                                                <td>Rp. {{ number_format($order->total_price) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-md">Back</a>
                                                @if ($orders->status_order === 'On the Way')
                                                @else
                                                    @if ($orders->status_order === 'Waiting')
                                                        <a href="{{ route('update.status.order', $orders->id) }}"
                                                            class="btn btn-danger btn-md">Cooked</a>
                                                    @else
                                                     <a href="{{ route('update.status.order', $orders->id) }}"
                                                            class="btn btn-danger btn-md">On the Way</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        @endsection

        @push('script-alt')
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>
        @endpush
