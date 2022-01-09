<table class="table table-sm">
    <thead>
        <tr>
            <th width="50%">Produk</th>
            <th width="20%">Jumlah</th>
            <th width="30%">Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->details as $detail)
            <tr>
                <td data-th="Produk">{{ $detail->product->name }}</td>
                <td data-th="Jumlah">{{ $detail->quantity }}</td>
                <td data-th="Harga" class="text-right">Rp.{{ number_format($detail->price, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td data-th="Subtotal">Subtotal</td>
                <td data-th="Subtotal" class="text-right" colspan="2">
                    Rp.{{ number_format($detail->total_price, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td data-th="Subtotal"><strong>Ongkos Kirim</strong></td>
            <td data-th="Subtotal" class="text-right" colspan="2">
                <strong>Rp.{{ number_format($order->total_fee, 2, ',', '.') }}</strong>
            </td>
        </tr>
        <tr>
            <td data-th="Subtotal"><strong>Total</strong></td>
            <td data-th="Subtotal" class="text-right" colspan="2">
                <strong>Rp.{{ number_format($order->total_payment, 2, ',', '.') }}</strong>
            </td>
        </tr>
    </tfoot>
</table>
