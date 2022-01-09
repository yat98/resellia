<div class="form-group row">
    <div class="col-md-4 text-right">
        <label>Order #</label>
    </div>
    <div class="col-md-6">
        {{ $order->padded_id }}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4 text-right">
        <label>Customer</label>
    </div>
    <div class="col-md-6">
        {{ $order->user->name }}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4 text-right">
        <label>Alamat Pengiriman</label>
    </div>
    <div class="col-md-6">
        <address>
            <strong>{{ $order->address->name }}</strong>
            <p class="m-0 p-0">{{ $order->address->detail }}</p>
            <p class="m-0 p-0">
                {{ $order->address->city->type }} {{ $order->address->city->city_name }},
                {{ $order->address->city->provinces->province }}
            </p>
            <abbr title="Phone" class="m-0 p-0">P:</abbr> +62 {{ $order->address->phone }}
        </address>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4 text-right">
        <label>Detail</label>
    </div>
    <div class="col-md-6">
        @include('orders._details')
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4 text-right">
        {{ Form::label('status', 'Status', ['class' => 'col-md-4 col-form-label']) }}
    </div>
    <div class="col-md-6 text-left">
        {{ Form::select('status', $statusList, null, ['id' => 'status', 'placeholder' => '-- Pilih Status --', 'class' => 'form-control text-left ' . ($errors->has('status') ? 'is-invalid' : '')]) }}
        {!! $errors->first('status', '<div id="status" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group row text-left">
    <div class="col-md-6 offset-md-4 radio">
        <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
</div>
