@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit {{ $order->title }}</h3>
                {{ Form::model($order, ['route' => ['orders.update', $order->id], 'method' => 'PATCH']) }}
                @include('orders._form')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
