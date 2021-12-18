@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Product
                    <small>
                        <a href="{{ route('products.create') }}" class="btn btn-warning btn-sm btn-icon ml-2">
                            <i class="fas fa-gift"></i>
                            New Product
                        </a>
                    </small>
                </h3>
                {{ Form::open(['route' => 'products.index', 'method' => 'GET']) }}
                <div class="form-group mr-1 my-4">
                    {{ Form::text('q', request()->q, ['id' => 'q', 'class' => 'form-control ' . ($errors->has('q') ? 'is-invalid' : ''), 'placeholder' => 'Type name / model...']) }}
                    {!! $errors->first('q', '<div id="q" class="invalid-feedback">:message</div>') !!}
                </div>
                {{ Form::close() }}
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Category</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->model }}</td>
                                <td>
                                    @foreach ($product->categories as $category)
                                        <span class="badge badge-primary">
                                            <i class="fas fa-tags"></i>
                                            {{ $category->title }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ Form::model($product, ['route' => ['products.destroy', $product], 'method' => 'DELETE']) }}
                                    <a href="{{ route('products.edit', $product) }}">Edit</a> |
                                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger js-submit-confirm']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
