@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Berhasil!</div>
                    <div class="card-body">
                        <p>Hi <strong>{{ session('order')->user->name }}</strong></p>
                        <p>Terima kasih telah berbelanja di {{ config('app.name') }}.</p>
                        <p>untuk melakukan pembayaran dengan
                            {{ config('bank-accounts')[session('order')->bank]['title'] }}:</p>
                        <ol>
                            <li>Silahkan transfer ke rekening
                                <strong>
                                    {{ config('bank-accounts')[session('order')->bank]['bank'] }}
                                    An.
                                    {{ config('bank-accounts')[session('order')->bank]['name'] }}
                                </strong>
                            </li>
                            <li>Ketika melakukan pembayaran sertakan nomor pesanan
                                <strong>{{ session('order')->padded_id }}</strong>.
                            </li>
                            <li>Total pembayaran
                                <strong>Rp.{{ number_format(session('order')->total_payment, 2, ',', '.') }}</strong></li>
                        </ol>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('catalogs.index') }}">Lanjutkan Belanja</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
