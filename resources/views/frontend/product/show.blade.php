    @extends('layouts.frontend')

    @section('content')
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>{{ $product->name_product }} Package</h2>
                            <div class="breadcrumb__option">
                                <a href="{{ route('homepage') }}">Home</a>
                                <span>{{ $product->name_product }} Package</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Product Details Section Begin -->
        <section class="product-details spad">
            <div class="container">
                @if (session()->has('message'))
                    {{-- <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show">
                        {{ session()->get('message') }}
                        <button class="close" type="button" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    {!! Toastr::message() !!}
                @endif
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img class="product__details__pic__item--large"
                                    src="{{ $product->gallery->first()->getUrl() }}" alt="">
                            </div>
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach ($product->getMedia('gallery') as $media)
                                    <img data-imgbigurl="{{ $media->getUrl() }}" src="{{ $media->getUrl() }}"
                                        alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3>{{ $product->name_product }} Package</h3>
                            <div class="product__details__price">Rp. {{ $product->price }}</div>
                            <p>{{ $product->details }}</p>
                            <div class="product__details__quantity" style="width: 150px">
                                <form method="post" action="{{ route('cart.store') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}" />
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input name="quantity" type="text" value="1">
                                        </div>
                                    </div>
                            </div>
                            <a type="submit" data-method="post" class="primary-btn">
                                <button type="submit"
                                    style="background: 0%; border:none; display:flexbox; font-weight:bold; color:white">ADD
                                    TO
                                    CART</button>
                            </a>
                            </form>

                            <ul>
                                <li><b>Availability</b> <span>In Stock</span></li>
                                <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                                <li><b>Weight</b> <span>0.5 kg</span></li>
                                <li><b>Share on</b>
                                    <div class="share">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                        aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                        aria-selected="false">Information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Description</h6>
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Details</h6>
                                        <p>{{ $product->details }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Details Section End -->

        <!-- Related Product Section Begin -->
        <section class="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title related__product__title">
                            <h2>Related Product</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($related_product as $relate)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ $relate->gallery->first()->getUrl() }}">
                                    <ul class="product__item__pic__hover">
                                        <li>
                                            <form method="post" action="{{ route('cart.store') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}" />
                                                <a type="submit" data-method="post">
                                                    <button type="submit"
                                                        style="border: none; color:transparent  background-color: transparent; border-radius:50% height: 40px;width: 40px; ">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a
                                            href="{{ route('product.show', $relate->slug) }}">{{ $relate->name_product }}</a>
                                    </h6>
                                    <h5>Rp. {{ $relate->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Related Product Section End -->
    @endsection

    @push('style-alt')
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    @endpush
