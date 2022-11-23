@extends('layouts.employee')

@section('content')
    @include('layouts.partials.sidebar')

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            @if (session()->has('message'))
                {!! Toastr::message() !!}
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Tinjauan Pesanan</p>
                            <div class="row">
                                <div class="col-12">
                                    <table id="table-od" cellpadding="5" class="table expandable-table table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th>No. Meja</th>
                                                <th>Metode Bayar</th>
                                                <th>Total</th>
                                                <th>Status Pesanan</th>
                                                <th>Status Pembayaran</th>
                                                <th>Tanggal Pesanan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <input type="hidden" class="delete_id" value="{{ $order->id }}">

                                                    <th>
                                                        <div class="badge badge-dark">{{ $order->table_id }}</div>
                                                    </th>
                                                    <td>
                                                        <div class="badge badge-light" style="font-weight:bold">
                                                            {{ strtoupper($order->invoice->payMethod) }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-light" style="font-weight: bold">Rp.
                                                            {{ number_format($order->invoice->total) }}</div>
                                                    </td>
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
                                                        @elseif($order->status_order === 'Pending')
                                                            <div class="badge badge-warning">
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
                                                    <td>{{ date('d F Y', strtotime($order->invoice->order_date)) }}</td>
                                                    <td>
                                                        <a href="{{ route('orders.show', $order->id) }}"
                                                            class="btn btn-info btn-md text-white"
                                                            style="height:40px; display:inline-flex; align-items:center; justify-content: center;"><i
                                                                class="ti-eye"></i> Detail</a>

                                                        @if (Auth::user()->HasRole('manager'))
                                                            <form action="{{ route('orders.destroy', $order->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-md btnactive"
                                                                    style="height:40px"><i class="ti-trash"></i>
                                                                    Hapus</button>
                                                            </form>
                                                        @endif

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
        </div>

        <!-- content-wrapper ends -->
    @endsection

    @push('style-alt')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @endpush

    @push('script-alt')
        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.btnactive').click(function(e) {
                    e.preventDefault();

                    var deleteid = $(this).closest("tr").find('.delete_id').val();

                    swal({
                            title: "Apakah anda yakin?",
                            text: "Setelah dihapus, Data Ini Tidak akan Bisa di Pulihkan Lagi!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })

                        .then((willDelete) => {
                            if (willDelete) {

                                var data = {
                                    "_token": $('input[name=_token]').val(),
                                    'id': deleteid,
                                };
                                $.ajax({
                                    type: "DELETE",
                                    url: 'orders/' + deleteid,
                                    data: data,
                                    success: function(response) {
                                        swal(response.status, {
                                                icon: "success",
                                            })
                                            .then((result) => {
                                                location.reload();
                                            });
                                    }
                                });
                            } else {
                                swal("Cancel!", "Perintah dibatalkan!", "error");

                            }
                        });
                });

            });
        </script>
    @endpush
