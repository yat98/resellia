@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                Akan diisi sidebar
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li>Kategori: Semua Produk</li>
                        </ol>
                    </div>
                    @forelse($products as $product)
                        <div class="col-md-6">
                            @include('catalogs._product-thumbnail')
                        </div>
                    @empty
                        <div class="col-12">
                            <h1>Data Produk Kosong!</h1>
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
