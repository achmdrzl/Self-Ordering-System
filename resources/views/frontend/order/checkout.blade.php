    @extends('layouts.frontend')

    @section('content')
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>Checkout</h2>
                            <div class="breadcrumb__option">
                                <a href="{{ route('homepage') }}">Home</a>
                                <span>Checkout</span>
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
                    <h4>Billing Details on Table {{ request()->session()->get('no_table') }}</h4>
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="checkout__order">
                                    <h4>Your Order</h4>
                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                    <ul>
                                        @foreach ($carts as $cart)
                                            <li>{{ $cart->name }} x{{ $cart->qty }} (Rp. {{ $cart->price }})<span>Rp.
                                                    {{ number_format($cart->price * $cart->qty) }}</span></li>
                                        @endforeach
                                    </ul>
                                    <div class="checkout__order__subtotal">Subtotal <span>Rp. {{ Cart::subtotal() }}</span>
                                    </div>
                                    <div class="checkout__order__total">Total <span>Rp. {{ Cart::total() }}</span></div>

                                    @if($data == 1)

                                    @else
                                    <p style="font-weight:500;">Metode Pembayaran</p>
                                    <div class="input-group">
                                        <div style="width:550px; box-sizing: border-box;">
                                            <select name="payMethod" id="payMethod" class="form-input">
                                                <option value="default" selected>-- Select Payment Method --</option>
                                                <option value="cashless">Cashless Method</option>
                                                <option value="cash">Cash Method</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div style="margin-bottom:25px"></div>
                                    <button type="submit" class="site-btn"
                                        {{ Cart::content()->count() < 1 ? 'disabled' : '' }}>PLACE ORDER</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Checkout Section End -->
    @endsection
