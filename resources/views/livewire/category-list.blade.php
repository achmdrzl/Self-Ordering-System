<div class="row">
    <div class="categories__slider owl-carousel">
        @foreach ($categories as $menu_category)
            <div class="col-lg-3">
                <div class="categories__item set-bg" data-setbg="{{ $menu_category->photo->getUrl() }}">
                    <h5><a href="{{ route('shop.index', $menu_category->slug) }}">{{ $menu_category->name_category }}</a>
                    </h5>
                </div>
            </div>
        @endforeach
    </div>
</div>
