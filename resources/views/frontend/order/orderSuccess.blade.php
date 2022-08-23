    @extends('layouts.frontend')

    @section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Order Success</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Order Success</span>
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
                                <h4 class="text-center">Thank you!. Your order hass been received😊.</h4> 
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-3">
                            <div class="text-center" style="
                            	background: #f5f5f5;
                                padding: 40px;
                                padding-top: 30px;
                            ">
                            <table class="table table-responsive-md" style="border:none;">
                                <thead>
                                    <th>Order Number</th>
                                    <th>No. Table</th>
                                    <th>Date Order</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>MG123</td>
                                        <td>15</td>
                                        <td>13/08/2022</td>
                                        <td>Rp. 154.000,-</td>
                                        <td>Cashless Method</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="col-lg-12 mt-4">
                    <div class="shoping__cart__btns">
                        <a href="#" class="secondary-btn cart-btn">BACK TO HOME</a>
                        <a href="#" class="secondary-btn cart-btn-right mt-2"><span class="icon_loading"></span>
                            CheckOrder</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    @endsection