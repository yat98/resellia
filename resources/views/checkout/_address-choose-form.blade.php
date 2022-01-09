<div class="form-group row">
    {{ Form::label('address_id', 'Alamat', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6 text-left">
        @foreach ($addresses as $address)
            <div class="row">
                <div class="col-md-2">
                    <label>
                        {{ Form::radio('address_id', $address->id, null) }}
                    </label>
                </div>
                <div class="col-md-10">
                    <address>
                        <strong>{{ $address->name }}</strong>
                        <p class="m-0 p-0">{{ $address->detail }}</p>
                        <p class="m-0 p-0">
                            {{ $address->city->type }} {{ $address->city->city_name }},
                            {{ $address->city->provinces->province }}
                        </p>
                        <p class="m-0 p-0">P:+62 {{ $address->phone }}</p>
                    </address>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-md-2 display-d is-invalid">
                <label>
                    {{ Form::radio('address_id', 'new-address', null) }}
                </label>
            </div>
            <div class="col-md-10">
                <strong>Alamat Baru</strong>
            </div>
            {!! $errors->first('address_id', '<div id="address_id" class="offset-md-2 col invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
<div id="js-new-address">
    @include('checkout._address-new-form')
</div>
