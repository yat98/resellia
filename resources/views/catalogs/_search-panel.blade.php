<div class="card mb-3">
    <div class="card-header">
        <h5>Cari produk</h5>
    </div>
    <div class="card-body">
        {{ Form::open(['route' => 'catalogs.index', 'method' => 'GET']) }}
        <div class="form-group">
            <strong>{{ Form::label('q', 'Apa yang kamu cari?') }}</strong>
            {{ Form::text('q', $q, ['class' => 'form-control ' . ($errors->has('q') ? 'is-invalid' : '')]) }}
            {!! $errors->first('q', '<div id="price" class="invalid-feedback">:message</div>') !!}
        </div>
        @if (!empty($cat))
            {{ Form::hidden('cat', $cat) }}
        @endif
        <div class="form-group">
            {{ Form::submit('Cari', ['class' => 'btn btn-primary w-100']) }}
        </div>
        {{ Form::close() }}
    </div>
</div>
