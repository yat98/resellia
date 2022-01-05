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
                            <th width="40%">Produk</th>
                            <th width="15%">Harga</th>
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
                                    <td data-th="Harga" class="align-middle">Rp.
                                        {{ number_format($order['detail']['price'], 2, ',', '.') }}</td>
                                    <td data-th="Jumlah" class="align-middle">
                                        {{ Form::open(['route' => ['cart.update', $order['id']], 'method' => 'PUT', 'class' => 'form-inline']) }}
                                        <div class="form-group">
                                            {{ Form::number('quantity', $order['quantity'], ['class' => 'text-center form-control', 'min' => 1]) }}
                                        </div>
                                    </td>
                                    <td data-th="Subtotal" class="text-center align-middle">Rp.
                                        {{ number_format($order['subTotal'], 2, ',', '.') }}</td>
                                    <td data-th=" " class="actions align-middle">
                                        <button class="btn btn-info btn-sm" type="submit">
                                            <i class="fas fa-sync text-white"></i>
                                        </button>
                                        {{ Form::close() }}
                                        {{ Form::open(['route' => ['cart.destroy', $order['id']], 'method' => 'DELETE', 'class' => 'form-inline']) }}
                                        <button class="btn btn-sm btn-danger js-submit-confirm"
                                            data-confirm-message="Kamu akan menghapus {{ $order['detail']['name'] }} dari cart">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        {{ Form::close() }}
                                    </td>
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
                                    <a href="{{ route('checkout.index') }}" class="btn btn-success btn-block">
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
