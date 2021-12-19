<div class="card mb-4">
    <div class="card-header">
        <h3>{{ $product->name }}</h3>
    </div>
    <div class="card-body">
        <img src="{{ asset('/storage/products/' . $product->photo) }}" class="img-thumbnail mb-3">
        <p>Model : {{ $product->model }}</p>
        <p>Harga : <strong>Rp. {{ number_format($product->price, 2, ',', '.') }}</strong></p>
        <p>
            Category :
            @foreach ($product->categories as $category)
                <span class="badge badge-primary">
                    <i class="fas fa-tags"></i>
                    {{ $category->title }}
                </span>
            @endforeach
        </p>
    </div>
</div>
