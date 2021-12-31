<div>
    {{ Form::open(['route' => 'cart', 'method' => 'POST']) }}
    {{ Form::hidden('product_id', $product->id) }}
    <div class="form-row">
        <div class="col-8">
            {{ Form::number('quantity', null, ['class' => 'form-control', 'min' => 1, 'placeholder' => 'Jumlah Order']) }}
        </div>
        <div class="col-4">
            {{ Form::submit('Tambah ke cart', ['class' => 'btn btn-primary']) }}
        </div>
    </div>
    {{ Form::close() }}
</div>
