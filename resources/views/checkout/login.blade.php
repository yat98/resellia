@extends('layouts.app')

@section('content')
    <div class="container">
        @include('checkout._step')
        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">Login atau Checkout tanpa mendaftar</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @include('checkout._login-form')
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
