<li class="nav-item">
    <a class="nav-link" href="{{ route('cart.show') }}">
        <i class="fas fa-shopping-cart"></i>
        {{ __('Cart') }} {{ $cart->totalProduct() > 0 ? "({$cart->totalProduct()})" : '' }}
    </a>
</li>
