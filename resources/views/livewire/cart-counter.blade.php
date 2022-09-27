<ul>

    @if($table == 0)
    @else
        <li>
            <a href="{{ route('status.order') }}" style="color:black;">Status <i class="fa fa-window-maximize"></i> <span>{{ number_format($table) }}</span></a>
        </li>
    @endif
    <li>
        <a href="{{ route('cart.index') }}" style="color:black;">Cart <i class="fa fa-shopping-bag"></i>
            <span>{{ $cart_count }}</span></a>
    </li>
</ul>
{{-- <div class="header__cart__price">item: <span>Rp. {{ $subtotal }}</span></div> --}}
