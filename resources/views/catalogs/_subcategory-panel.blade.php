<div class="card mb-3">
    <div class="card-header">
        <h5>Subkategori untuk {{ $current_category->title }}</h5>
    </div>
    <div class="list-group list-group-flush">
        @foreach ($current_category->childs as $category)
            <a href="{{ url('catalogs?cat=' . $category->id) }}"
                class="list-group-item d-flex justify-content-between align-items-center">
                {{ $category->title }}
                <span class="badge badge-dark">{{ $category->total_products }}</span>
            </a>
        @endforeach
    </div>
</div>
