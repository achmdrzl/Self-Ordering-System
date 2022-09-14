
    @extends('layouts.employee')

    @section('content')
    
    @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show">
                        {{ session()->get('message') }}
                        <button class="close" type="button" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Payment Section</p>
                                <div class="row">
                                    <div class="col-12">
                                        <table id="table-id" cellpadding="5"
                                            class="table display expandable-table table-responsive-lg" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.Table</th>
                                                    <th>Payment Method</th>
                                                    <th>Total</th>
                                                    <th>Status Order</th>
                                                    <th>Order Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Cashless</td>
                                                    <td>Rp. 150.000,-</td>
                                                    <td>Pending</td>
                                                    <td>23/08/2022</td>
                                                    <td>
                                                        <button id="pay-button" class="btn btn-danger">Cashless</button>
                                                            <a href="#" class="btn btn-warning">Cash</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
            <script type="text/javascript">
                // For example trigger on button clicked, or any time you need
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay("{{ $snapToken }}");
                    // customer will be redirected after completing payment pop-up
                });
            </script>
        @endpush
