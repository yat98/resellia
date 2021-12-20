<div class="col-md-12">
    <ol class="breadcrumb">
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
    </ol>
</div>
