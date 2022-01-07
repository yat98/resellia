<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills nav-fill card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link h5 {{ request()->is('checkout/login') ? 'active' : 'disabled' }}"
                            href="{{ route('checkout.login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link h5 {{ request()->is('checkout/address') ? 'active' : 'disabled' }}"
                            href="{{ route('checkout.address') }}">Alamat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link h5 {{ request()->is('checkout/payment') ? 'active' : 'disabled' }}"
                            href="#">Pembayaran</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
