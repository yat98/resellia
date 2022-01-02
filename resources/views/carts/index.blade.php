@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($cart->isEmpty())
                    <div class="text-center">
                        <h1>:|</h1>
                        <p>Cart kamu masih kosong.</p>
                        <p><a href="{{ route('catalogs.index') }}">Lihat semua produk <i
                                    class="fas fa-arrow-right"></i></a></p>
                    </div>
                @else
                    <table class="cart table table-hover table-sm">
                        <thead>
                            <th width="45%">Produk</th>
                            <th width="10%">Harga</th>
                            <th width="8%">Jumlah</th>
                            <th width="22%" class="text-center">Subtotal</th>
                            <th width="15%"> </th>
                        </thead>
                        <tbody>
                            @foreach ($cart->details() as $order)
                                <tr>
                                    <td data-th="Produk">
                                        <div class="row">
                                            <div class="col-sm-2 d-none-sm">
                                                <img src="{{ asset('/storage/products/' . $order['detail']['photo']) }}"
                                                    class="w-75 rounded">
                                            </div>
                                            <div class="col-sm-10 d-flex align-items-center">
                                                <h5 class="nomargin">{{ $order['detail']['name'] }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Harga" class="align-middle">{{ $order['detail']['price'] }}</td>
                                    <td data-th="Jumlah" class="align-middle">{{ $order['quantity'] }}</td>
                                    <td data-th="Subtotal" class="text-center align-middle">
                                        {{ number_format($order['subTotal'], 2, ',', '.') }}</td>
                                    <td class="align-middle">Untuk action</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <a href="{{ route('catalogs.index') }}" class="btn btn-warning">
                                        <i class="fas fa-angle-left"></i> Belanja lagi
                                    </a>
                                </td>
                                <td colspan="2"></td>
                                <td class="text-center align-middle">
                                    <strong>Total
                                        Rp.{{ number_format($cart->totalPrice(), 2, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <a href="{{ url('/checkout/login') }}" class="btn btn-success btn-block">
                                        Pembayaran <i class="fas fa-angle-right"></i>
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
