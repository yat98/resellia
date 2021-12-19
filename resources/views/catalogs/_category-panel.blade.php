<div class="card mb-3">
    <div class="card-header">
        <h5>Lihat per kategori</h5>
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ url('catalogs') }}" class="list-group-item d-flex justify-content-between align-items-center">
            Semua produk
            <span class="badge badge-dark">{{ $countProducts }}</span>
        </a>
        @foreach ($categoryNoParent as $category)
            <a href="{{ url('catalogs?cat=' . $category->id) }}"
                class="list-group-item d-flex justify-content-between align-items-center">
                {{ $category->title }}
                <span class="badge badge-dark">{{ $category->total_products }}</span>
            </a>
        @endforeach
    </div>
</div>
