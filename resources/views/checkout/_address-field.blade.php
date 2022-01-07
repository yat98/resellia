<div class="form-group row">
    {{ Form::label('name', 'Nama', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6 text-left">
        {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : '')]) }}
        {!! $errors->first('name', '<div id="name" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('detail', 'Alamat', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6 text-left">
        {{ Form::textarea('detail', null, ['id' => 'detail', 'rows' => 5, 'class' => 'form-control ' . ($errors->has('detail') ? 'is-invalid' : '')]) }}
        {!! $errors->first('detail', '<div id="detail" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('province_id', 'Provinsi', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6 text-left">
        {{ Form::select('province_id', $provinces, null, ['id' => 'province_id', 'placeholder' => '-- Pilih Provinsi --', 'class' => 'form-control text-left ' . ($errors->has('province_id') ? 'is-invalid' : '')]) }}
        {!! $errors->first('province_id', '<div id="province_id" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('city_id', 'Kabupaten / Kota', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6 text-left">
        {{ Form::select('city_id', $cities, null, ['id' => 'city_id', 'placeholder' => '-- Pilih Kabupaten / Kota --', 'class' => 'form-control text-left ' . ($errors->has('city_id') ? 'is-invalid' : '')]) }}
        {!! $errors->first('city_id', '<div id="city_id" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('phone', 'Telepon', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6 text-left">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">+62</div>
            </div>
            {{ Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control ' . ($errors->has('phone') ? 'is-invalid' : '')]) }}
            {!! $errors->first('phone', '<div id="phone" class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
