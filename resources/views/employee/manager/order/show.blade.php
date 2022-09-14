    {{-- @dd($items) --}}
    @extends('layouts.employee')

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
                                                    @foreach($orders as $order)
                                                    <tr>
                                                        <th>No Table</th>
                                                        <th colspan="6">{{ $order->table_id }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Order Date</th>
                                                        <td colspan="6">{{ $order->order_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Method</th>
                                                        <td colspan="6">{{ strtoupper($order->payMethod) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total</th>
                                                        <td colspan="6">Rp. {{ $order->total }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                <table class="table mb-4 display expandable-table table-responsive-md">
                                                    <thead>
                                                        <th>No</th>
                                                        <th>Menu Order</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderProducts as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->product_id }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>{{ $item->total_price }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <a href="{{ route('orders.index') }}" class="btn btn-primary btn-md">Back</a>
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
