<div>

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('message'))
                        <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show">
                            {{ session()->get('message') }}
                            <button class="close" type="button" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="shoping__cart__table">
                        <table>
                            @if (Cart::count() > 0)
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            @foreach ($imgs as $img)
                                                @if ($img->id == $product->id)
                                                    <img src="{{ $img->gallery->first()->getUrl() }}" alt=""
                                                        width="80px">
                                                @endif
                                            @endforeach
                                            <h5 style="font-weight: bold; font-size: 1.5em">{{ $product->name }}
                                            </h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            Rp. {{ number_format($product->price) }}
                                        </td>
                                            {{-- <div class="w-20 h-10">
                                                <div
                                                    class="relative flex flex-row content-center justify-center w-full h-8 border-2 border-green-200">
                                                    <button
                                                        wire:click.prevent="increaseQuantity('{{ $product->rowId }}')"
                                                        class="text-gray-500 focus:outline-none focus:text-gray-600">
                                                        <svg class="w-5 h-5" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                        </svg>
                                                    </button>
                                                    <p>{{ $product->qty }}</p>
                                                    <button
                                                        wire:click.prevent="decreaseQuantity('{{ $product->rowId }}')"
                                                        class="text-gray-500 focus:outline-none focus:text-gray-600">
                                                        <svg class="w-5 h-5" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div> --}}
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="" style="background-color:whitesmoke; width:130px; height:30px; justify-content:center; margin: 0 auto;">
                                                    <button
                                                        wire:click.prevent="decreaseQuantity('{{ $product->rowId }}')"
                                                        style="border: none; background:whitesmoke">-</button>
                                                    <input id=demoInput type=number min=1 max=100
                                                        value="{{ $product->qty }}" readonly
                                                        style="border:none; background:whitesmoke; text-align:center; width:35px; margin:auto;">
                                                    <button
                                                        wire:click.prevent="increaseQuantity('{{ $product->rowId }}')"
                                                        style="border: none; background:whitesmoke">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            Rp. {{ number_format($product->price * $product->qty) }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <div>
                                                <button wire:click="removeItem('{{ $product->rowId }}');"
                                                    class="btn btn-danger btn-md"
                                                    style="width: 50px; height:40px; background-color: transparent; border: none; :focus{outline:none; box-shadow:none}"><span
                                                        class="icon_close"></span></button>
                                            </div>
                                        </td>
                                        <td>
                                        @empty
                                            <div class="row justify-content-center">
                                                <div class="col-lg-12 col-md-12"
                                                    style="display: flex; justify-content: center; align-items:center;">
                                                    <img src="{{ asset('imgs/empty-cart.png') }}" alt=""
                                                        width="350px;">
                                                    {{-- <h6 style=""><span>Product Empty</span></h6> --}}
                                                    <button class="close" type="button" data-dismiss="alert"></button>
                                                </div>
                                            </div>
                                @endforelse
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns"
                        style=" {{ Cart::count() > 0 ? '' : 'display: flex; justify-content: center; align-items:center' }}">
                        <a href="{{ route('homepage') }}" class="secondary-btn cart-btn" style="matgin-top:50px">CONTINUE SHOPPING</a>
                        @if (Cart::count() > 0)
                            <a href="{{ route('order.index') }}" class="secondary-btn cart-btn" style="matgin-top:50px" >PROCCED TO CHECKOUT</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    {{-- <div class="shoping__continue">
                          <div class="shoping__discount">
                              <h5>Discount Codes</h5>
                              <form action="#">
                                  <input type="text" placeholder="Enter your coupon code">
                                  <button type="submit" class="site-btn">APPLY COUPON</button>
                              </form>
                          </div>
                      </div> --}}
                </div>
                {{-- @if (Cart::count() > 0)
                  <div class="col-lg-6">
                      <div class="shoping__checkout">
                          <h5>Cart Total</h5>
                          <ul>
                              <li>Total Items <span>{{ Cart::count() }} Items</span></li>
                              <li>Total <span>Rp. {{ Cart::total() }}</span></li>
                          </ul>
                          <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                      </div>
                  </div>
                  @endif --}}
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
</div>
