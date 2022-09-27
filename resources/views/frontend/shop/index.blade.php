    @extends('layouts.frontend')

    @section('content')
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>Organi Shop</h2>
                            <div class="breadcrumb__option">
                                <a href="{{ route('homepage') }}">Home</a>
                                <span>Shop</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Product Section Begin -->
        <section class="product spad">
            <div class="container">
                @if (session()->has('message'))
                    {!! Toastr::message() !!}
                @endif
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="filter__item">
                            <div class="row">
                                <div class="col-lg-4 col-md-5">
                                    <form method="get">
                                        <div class="filter__sort">
                                            <span>Sort By</span>
                                            <select name="sortingBy" onchange="this.form.submit()">
                                                <option {{ $sorting === 'default' ? 'selected' : null }} value="default">
                                                    Default</option>
                                                <option {{ $sorting === 'low-high' ? 'selected' : null }} value="low-high">
                                                    Low to High</option>
                                                <option {{ $sorting === 'high-low' ? 'selected' : null }} value="high-low">
                                                    High to Low</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="filter__found">
                                        <h6><span>{{ $products->total() }}</span> Products found</h6>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3">
                                    <div class="filter__option">
                                        <span class="icon_grid-2x2"></span>
                                        <span class="icon_ul"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @forelse($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ $product->gallery->first()->getUrl() }}">
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
                                                    href="{{ route('product.show', $product->slug) }}">{{ $product->name_product }}</a>
                                            </h6>
                                            <h5>@currency($product->price)</h5>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12 col-md-12">
                                    <div class="filter__found">
                                        <h6><span>Product Empty</span></h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Section End -->
    @endsection

    @push('style-alt')
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    @endpush
