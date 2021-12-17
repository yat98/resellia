@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit {{ $product->name }}</h3>
                {{ Form::model($product, ['route' => ['products.update', $category], 'method' => 'PATCH', 'files' => true]) }}
                @include('products._form')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
