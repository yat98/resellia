@extends('layouts.app')

@section('content')
    <div class="container">
        @include('checkout._step')
        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        Alamat Pengiriman
                    </div>
                    <div class="card-body text-center">
                        @include('checkout._address-new-form')
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">Cart</div>
                    <div class="card-body">
                        @include('checkout._cart-panel')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
