<div class="col-md-12">
    <ol class="breadcrumb d-flex justify-content-between">
        @if (!is_null($current_category) && !empty($q))
            <li>
                Kategori:
                <a href="{{ url('catalogs?cat=' . $current_category->id) }}">
                    {{ $current_category->title }}
                </a>,
                Keyword:
                <a href="{{ url('catalogs?q=' . $q) }}">
                    {{ $q }}
                </a>
            </li>
        @elseif (!is_null($current_category))
            <li>
                Kategori:
                <a href="{{ url('catalogs?cat=' . $current_category->id) }}">
                    {{ $current_category->title }}
                </a>
            </li>
        @elseif(!empty($q))
            <li>
                Keyword:
                <a href="{{ url('catalogs?q=' . $q) }}">
                    {{ $q }}
                </a>
            </li>
        @else
            <li>Kategori: Semua Produk</li>
        @endif
        <li>
            Urutkan harga :
            <a href="{{ appendsQueryString(['sort' => 'price', 'order' => 'asc']) }}"
                class="btn btn-sm btn-light 
                {{ isQueryStringEqual(['sort' => 'price', 'order' => 'asc']) ? 'active' : '' }}">
                Termurah
            </a>
            |
            <a href="{{ appendsQueryString(['sort' => 'price', 'order' => 'desc']) }}"
                class="btn btn-sm btn-light 
                {{ isQueryStringEqual(['sort' => 'price', 'order' => 'desc']) ? 'active' : '' }}">
                Termahal
            </a>
        </li>
    </ol>
</div>
