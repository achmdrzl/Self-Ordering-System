    @extends('layouts.frontend')

    @section('content')
        <!-- Categories Section Begin -->
        <section class="categories">
            <div class="container">
                @livewire('category-list')
            </div>
        </section>
        <!-- Categories Section End -->

        <!-- Featured Section Begin -->
        <section class="featured spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>List Categories</h2>
                        </div>
                    </div>
                </div>
                {{-- <div class="row featured__filter" id="category-list"> --}}
                <div class="row featured__filter">
                    @foreach ($menu_categories as $menu_category)
                        <div class="col-lg-4 col-md-6 col-sm-12 mix">
                            <div class="featured__item">
                                <a href="{{ route('shop.index', $menu_category->slug) }}">
                                    <div class="featured__item__pic set-bg"
                                        data-setbg="{{ $menu_category->photo->getUrl() }}"></div>
                                </a>
                                <div class="featured__item__text">
                                    <h5><a href="{{ route('shop.index', $menu_category->slug) }}"
                                            style="color:black">{{ $menu_category->name_category }}</a></h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Featured Section End -->
    @endsection
