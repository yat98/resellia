<table class="table table-sm">
    <thead>
        <tr>
            <th width="50%">Produk</th>
            <th width="20%">Jumlah</th>
            <th width="30%">Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cart->details() as $order)
            <tr>
                <td data-th="Produk">{{ $order['detail']['name'] }}</td>
                <td data-th="Jumlah" class="text-center">{{ $order['quantity'] }}</td>
                <td data-th="Harga" class="text-right">
                    Rp.{{ number_format($order['detail']['price'], 2, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td data-th="Subtotal">Subtotal</td>
                <td data-th="Subtotal" class="text-right" colspan="2">
                    Rp.{{ number_format($order['subTotal'], 2, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        @if (request()->routeIs('checkout.payment'))
            <tr>
                <td><strong>Total</strong></td>
                <td class="text-right" colspan="2">
                    <strong>
                        Rp.{{ number_format($cart->totalPrice(), 2, ',', '.') }}
                    </strong>
                </td>
            </tr>
            <tr>
                <td><strong>Ongkos Kirim</strong></td>
                <td class="text-right" colspan="2">
                    <strong>
                        Rp.{{ number_format($cart->shippingFee(), 2, ',', '.') }}
                    </strong>
                </td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td class="text-right" colspan="2">
                    <strong>
                        Rp.{{ number_format($cart->totalPrice() + $cart->shippingFee(), 2, ',', '.') }}
                    </strong>
                </td>
            </tr>
        @else
            <tr>
                <td><strong>Total</strong></td>
                <td class="text-right" colspan="2">
                    <strong>
                        Rp.{{ number_format($cart->totalPrice(), 2, ',', '.') }}
                    </strong>
                </td>
            </tr>
        @endif
    </tfoot>
</table>
