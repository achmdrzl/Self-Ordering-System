    @extends('layouts.frontend')

    @section('content')

        <!-- Breadcrumb Section Begin -->
      <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 text-center">
                      <div class="breadcrumb__text">
                          <h2>Shopping Cart</h2>
                          <div class="breadcrumb__option">
                              <a href="{{ route('homepage') }}">Home</a>
                              <span>Shopping Cart</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Breadcrumb Section End -->

        @livewire('cart-list')

    @endsection