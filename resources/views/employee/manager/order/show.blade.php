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
                                            <p class="card-title">Detail Order : <span>Table
                                                    {{ $orders->table_id }}</span></p>
                                            <table class="table table-hover mb-4">
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
                                                    <form id="submitForm"
                                                        action="{{ route('cashless.pay', $orders->invoice->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="result" id="callback">
                                                    </form>
                                                </tr>
                                                @if ($orders->invoice->payMethod === 'cashless')
                                                @else
                                                    <tr>
                                                        <th>Total Payment</th>
                                                        <td colspan="6">Rp.
                                                            {{ number_format($orders->invoice->payTotal) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Change Money</th>
                                                        <td colspan="6">Rp.
                                                            {{ number_format($orders->invoice->PayBack) }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <th>Status Payment</th>
                                                    <td colspan="6">
                                                        <div
                                                            class="badge badge-{{ $orders->invoice->status === 'Unpaid' ? 'danger' : 'success' }}">
                                                            {{ strtoupper($orders->invoice->status) }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table mb-4 display expandable-table table-responsive-md">
                                                <thead>
                                                    <th>No</th>
                                                    <th>Menu Order</th>
                                                    <th>Qty</th>
                                                    <th>Total</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders->orderProduct as $order)
                                                        <tr>
                                                            {{-- @dd($order->products) --}}
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $order->product->name_product }}</td>
                                                            <td>{{ $order->quantity }}</td>
                                                            <td>Rp. {{ number_format($order->total_price) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if ($orders->invoice->status == 'settlement' || $orders->invoice->status == 'Settlement')
                                                <a href="{{ route('print.pdf', $orders->id) }}" class="btn btn-dark btn-md"
                                                    style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                        class="ti-printer"></i><span> Print Receipt</span></a>
                                            @else
                                                @if ($orders->invoice->payMethod === 'cashless')
                                                    <button type="submit" id="pay-button" class="btn btn-danger"
                                                        style="width:150px">Pay!</button>
                                                @else
                                                    <a class="btn btn-danger" data-bs-toggle="modal" href="#exampleModal"
                                                        role="button" style="width:150px;">Pay!</a>
                                                @endif
                                            @endif
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

        {{-- Modal Content Cash Method --}}
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cash Payment Method</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="background: transparent; border:none;">x</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('cash.pay', $orders->id) }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2" style="font-weight: bold">No
                                    Table</span>
                                <input type="text" class="form-control" name="noTable" value="{{ $orders->table_id }}"
                                    readonly />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="num1" style="font-weight: bold">Total
                                    Payment</span>
                                <input type="text" class="form-control" name="total"
                                    value="Rp. {{ number_format($orders->invoice->total) }}" readonly />
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2" style="font-weight: bold">Payment
                                    Total</span>
                                <input type="text" id="num2" class="form-control" name="payTotal"
                                    placeholder="Input Payment Total" required />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Pay!</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="color: white">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal --}}
    @endsection

    @push('script-alt')
        <script type="text/javascript">
            // For example trigger on button clicked, or any time you need
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function() {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        /* You may add your own implementation here */
                        // alert("payment success!");
                        console.log(result);
                        sendResponse(result);
                    },
                    onPending: function(result) {
                        /* You may add your own implementation here */
                        // alert("wating your payment!");
                        console.log(result);
                        sendResponse(result);
                    },
                    onError: function(result) {
                        /* You may add your own implementation here */
                        // alert("payment failed!");
                        console.log(result);
                        sendResponse(result);
                    },
                    onClose: function() {
                        /* You may add your own implementation here */
                        // alert('you closed the popup without finishing the payment');
                    }
                })
            });

            function sendResponse(result) {
                let data = document.getElementById('callback').value = JSON.stringify(result);
                $('#submitForm').submit();
            }

            var rupiah = document.getElementById('payTotal');
            rupiah.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value, 'Rp. ');
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            $('.input-group').on('input', '.form-control', function() {
                var totalSum = 0;
                $('.form-control').each(function() {
                    var inputVal = $(this).val();
                    if ($.isNumeric(inputVal)) {
                        totalSum -= parseFloat(inputVal);
                    }
                });
                $('#result').text(totalSum);
            })
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    @endpush
