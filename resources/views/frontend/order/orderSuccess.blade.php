@extends('layouts.frontend')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Pesanan Berhasil!</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Beranda</a>
                            <span>Pesanan Berhasil!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="checkout__order2">
                                <h4 class="text-center">Terima Kasih! Pesanan Kamu Sudah Kami Terima!😊</h4>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-3">
                            <div class="text-center"
                                style="
                            	background: #f5f5f5;
                                padding: 40px;
                                padding-top: 30px;
                            ">
                                <table class="table table-responsive-md" style="border:none;">
                                    <thead>
                                        <th>Nomor Pesanan</th>
                                        <th>No. Meja</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Total</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status Pesanan</th>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($orders) --}}
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ strtoupper($order->orderCode) }}</td>
                                                <td>{{ $order->table_id }}</td>
                                                <td>{{ date('d F Y', strtotime($order->invoice->order_date)) }}</td>
                                                <td>Rp. {{ number_format($order->invoice->total) }}</td>
                                                <td>{{ strtoupper($order->invoice->payMethod) }}</td>
                                                <td>{{ strtoupper($order->status_order) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-12 mt-4">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('homepage') }}" class="secondary-btn cart-btn">Kembali ke Beranda</a>
                        {{-- <a href="#" class="secondary-btn cart-btn-right mt-2"><span class="icon_loading"></span>
                            CheckOrder</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
