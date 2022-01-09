@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'orders.index', 'method' => 'GET', 'class' => 'row my-4']) }}
                <div class="col-10">
                    <div class="row">
                        <div class="col-6 m-0 pr-2">
                            {{ Form::text('q', request()->q, ['id' => 'q', 'class' => 'form-control ' . ($errors->has('q') ? 'is-invalid' : ''), 'placeholder' => 'Type Order ID or customer name...']) }}
                            {!! $errors->first('q', '<div id="q" class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="col-6 m-0 p-0 pr-2">
                            {{ Form::select('status', $statusList, request()->status, ['id' => 'status', 'class' => 'form-control ' . ($errors->has('status') ? 'is-invalid' : ''), 'placeholder' => '-- Pilih Status --']) }}
                            {!! $errors->first('status', '<div id="status" class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
                <div class="col-2 m-0 p-0">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>
                </div>
                {{ Form::close() }}
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Update terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('orders.edit', $order->id) }}">{{ $order->padded_id }}</a>
                                </td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->human_status }}</td>
                                <td>
                                    Total: <strong>Rp.{{ number_format($order->total_payment, 2, ',', '.') }}</strong>
                                    <br>
                                    Transfer ke: <strong>{{ config('bank-accounts')[$order->bank]['bank'] }}</strong> <br>
                                    Dari: {{ $order->sender }}
                                </td>
                                <td>{{ $order->updated_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada order yang ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection
