@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('catalogs._search-panel',[
                'cat' => isset($cat) ? $cat :'',
                'q' => isset($q) ? $q :'',
                ])
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
                    @include('catalogs._breadcrumb',[
                    'current_category' => isset($category) ? $category : null,
                    'q' => isset($q) ? $q :'',
                    ])
                    @forelse($products as $product)
                        <div class="col-md-6">
                            @include('catalogs._product-thumbnail')
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            @if (isset($q))
                                <h1>:(</h1>
                                <p>Produk yang kamu cari tidak ditemukan.</p>
                                @if (isset($category))
                                    <p>
                                        <a href="{{ url('catalogs?q=' . $q) }}">
                                            Cari di semua kategori <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </p>
                                @endif
                            @else
                                <h1>:|</h1>
                                <p>Belum ada produk yang untuk kategori ini.</p>
                            @endif
                            <p>
                                <a href="{{ url('catalogs') }}">
                                    Lihat semua produk <i class="fas fa-arrow-right"></i>
                                </a>
                            </p>
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
