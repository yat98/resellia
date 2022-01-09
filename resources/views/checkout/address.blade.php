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
                        {{ Form::open(['route' => ['checkout.post-address'], 'method' => 'POST']) }}
                        @if (auth()->check())
                            @include('checkout._address-choose-form',['addresses' => $addresses])
                        @else
                            @include('checkout._address-new-form')
                        @endif
                        <div class="form-group text-left">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Lanjut <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
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
