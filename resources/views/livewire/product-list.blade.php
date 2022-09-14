<div class="row">
    @forelse($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ $product->gallery->first()->getUrl() }}">
                    <ul class="product__item__pic__hover">
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name_product }}</a>
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
