@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('catalogs._category-panel')
                @if (isset($category) && $category->hasChild())
                    @include('catalogs._subcategory-panel',['current_category' => $category])
                @endif
                @if (isset($category) && $category->hasParent())
                    @include('catalogs._subcategory-panel',['current_category' => $category->parent])
                @endif
            </div>
            <div class="col-md-9">
                <div class="row">
                    @include('catalogs._breadcrumb',['current_category' => isset($category) ? $category : null])
                    @forelse($products as $product)
                        <div class="col-md-6">
                            @include('catalogs._product-thumbnail')
                        </div>
                    @empty
                        <div class="col-12">
                            <h1 class="text-center">Data Produk Kosong!</h1>
                        </div>
                    @endforelse
                    <div class="col-12 d-flex justify-content-end">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
