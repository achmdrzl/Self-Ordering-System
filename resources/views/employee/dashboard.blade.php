    @extends('layouts.employee')

    @section('content')
        @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">{{ ucfirst(Auth::user()->name) }}</h3>
                                <h6 class="font-weight-normal mb-0">All systems are running smoothly! <span
                                        class="text-primary">Howdy?</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if (Auth::user()->HasRole('cashier') or Auth::user()->HasRole('chef') or Auth::user()->HasRole('manager'))
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card tale-bg">
                                <div class="card-people mt-auto">
                                    <img src="{{ asset('backend/images/dashboard/people.svg') }}" alt="people">
                                    <div class="weather-info">
                                        <div class="d-flex">
                                            <div>
                                                <h2 class="mb-0 font-weight-normal">
                                                    <i
                                                        class="icon-sun mr-2"></i>{{ round($location->latitude) }}<sup>C</sup>
                                                    {{-- <i class="icon-sun mr-2"></i>29<sup>C</sup> --}}
                                                </h2>
                                            </div>
                                            <div class="ml-2">
                                                <h4 class="location font-weight-normal">{{ $location->regionName }}</h4>
                                                <h6 class="font-weight-normal">{{ $location->countryName }}</h6>
                                                {{-- <h4 class="location font-weight-normal">Surabaya</h4>
                                            <h6 class="font-weight-normal">Indonesia</h6> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin transparent">
                            <div class="row">
                                <div
                                    class="col-md-{{ Auth::user()->HasRole('cashier') || Auth::user()->HasRole('chef') == 1 ? '12' : '6' }} mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">Today’s Orders</p>
                                            <p class="fs-30 mb-2">
                                                @if ($orderThisDay === null)
                                                    0
                                                @else
                                                    {{ $orderThisDay->total }}
                                                @endif
                                            </p>
                                            <p>this day!</p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-md-{{ Auth::user()->HasRole('cashier') || Auth::user()->HasRole('chef') == 1 ? '12' : '6' }} mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Total Tables</p>
                                            <p class="fs-30 mb-2">{{ $table }}</p>
                                            <p>{{ $tableFree }} in free!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->HasRole('manager'))
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                        <div class="card card-light-blue">
                                            <div class="card-body">
                                                <p class="mb-4">Amount Income</p>
                                                <p class="fs-30 mb-2">Rp.
                                                    @if ($orderThisDay === null)
                                                        0
                                                    @else
                                                        {{ number_format($totalThisDay->total) }}
                                                    @endif
                                                </p>
                                                <p>this day!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 stretch-card transparent">
                                        <div class="card card-light-danger">
                                            <div class="card-body">
                                                <p class="mb-4">Total Income</p>
                                                <p class="fs-30 mb-2">Rp. {{ number_format($grandTotal) }}</p>
                                                <p>all time!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                </div>
                <div class="row">
                    @if (Auth::user()->HasRole('manager'))
                        <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Income Review</p>
                                    <p class="font-weight-500">The total number of income we got.</p>
                                    <div class="d-flex flex-wrap mb-3">
                                        <div class="mt-3">
                                            {{-- <p class="text-muted">Downloads</p>
                                            <h3 class="text-primary fs-30 font-weight-medium">34040</h3> --}}
                                        </div>
                                    </div>
                                    {{-- <canvas id="order-chart"></canvas> --}}
                                    <div id="order-chart">
                                        {!! $reportChart->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @endif

                @if (Auth::user()->HasRole('chef'))
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Order Review</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="table-id" cellpadding="5"
                                                class="table display expandable-table table-responsive-lg"
                                                style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Table</th>
                                                        <th>Total</th>
                                                        <th>Status Order</th>
                                                        <th>Status Payment</th>
                                                        <th>Order Date</th>
                                                        {{-- <th>Order Time</th> --}}
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $order)
                                                        <tr>
                                                            <th>
                                                                <div class="badge badge-dark">{{ $order->table_id }}</div>
                                                            </th>
                                                            <th>
                                                                <div class="badge badge-light" style="font-weight: bold">
                                                                    Rp. {{ number_format($order->invoice->total) }}</div>
                                                            </th>
                                                            <td>
                                                                @if ($order->status_order === 'Cooked')
                                                                    <div class="badge badge-warning">
                                                                        {{ $order->status_order }}
                                                                    </div>
                                                                @elseif($order->status_order === 'Waiting')
                                                                    <div class="badge badge-danger">
                                                                        {{ $order->status_order }}
                                                                    </div>
                                                                @elseif($order->status_order === 'On the Way')
                                                                    <div class="badge badge-info">
                                                                        {{ $order->status_order }}
                                                                    </div>
                                                                @else
                                                                    <div class="badge badge-success">
                                                                        {{ $order->status_order }}
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($order->invoice->status === 'Unpaid')
                                                                    <div class="badge badge-danger">
                                                                        {{ ucfirst($order->invoice->status) }}
                                                                    </div>
                                                                @elseif($order->invoice->status === 'pending')
                                                                    <div class="badge badge-warning">
                                                                        {{ ucfirst($order->invoice->status) }}
                                                                    </div>
                                                                @else
                                                                    <div class="badge badge-success">
                                                                        {{ ucfirst($order->invoice->status) }}
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>{{ date('d F Y', strtotime($order->invoice->order_date)) }}
                                                            </td>
                                                            {{-- <td>{{ $order->created_at->diffForHumans() }}</td> --}}
                                                            <td>
                                                                <a href="{{ route('show.order', $order->id) }}"
                                                                    class="btn btn-info btn-md text-white"
                                                                    style="width: 60px; height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                        class="ti-eye"></i> Detail</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- content-wrapper ends -->
            @endsection


            @push('script-alt')
                {!! $reportChart->script() !!}
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
                {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script> --}}
                <script type="text/javascript">
                    var total = {{ json_encode($totalSales) }}
                    const month = {{ json_encode($month) }}
                    // var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                    //     'November', 'December'
                    // ]

                    console.log(total);

                    Highcharts.chart('order-chart', {
                        title: {
                            text: 'Graphics Sales by Month'
                        },
                        xAxis: {
                            categories: month
                        },
                        yAxis: {
                            title: {
                                text: 'Overall Income'
                            }
                        },
                        plotOption: {
                            series: {
                                allowPointSelect: true
                            }
                        },
                        series: [{
                            name: 'Nominal Income',
                            data: total
                        }]
                    })
                </script>
            @endpush
