@extends('layouts.app')

@section('content')
    <div class="container">
        @include('checkout._step')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Permintaan Password</div>
                    <div class="card-body">
                        @include('checkout._request-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
