{{ Form::open(['route' => 'checkout.post-payment', 'method' => 'POST', 'class' => 'text-center']) }}
<div class="form-group row">
    {{ Form::label('bank_name', 'Pilih Bank Yang Anda Gunakan', ['class' => 'text-right col-md-4 col-form-label']) }}
    <div class="col-md-6 text-left">
        {{ Form::select('bank_name', bankList(), null, ['id' => 'bank_name', 'class' => 'form-control ' . ($errors->has('bank_name') ? 'is-invalid' : '')]) }}
        {!! $errors->first('bank_name', '<div id="bank_name" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('sender', 'Nama Pengirim', ['class' => 'text-right col-md-4 col-form-label']) }}
    <div class="col-md-6 text-left">
        {{ Form::text('sender', null, ['id' => 'sender', 'class' => 'form-control ' . ($errors->has('sender') ? 'is-invalid' : '')]) }}
        {!! $errors->first('sender', '<div id="sender" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group row text-left">
    <div class="col-md-6 offset-md-4 radio">
        <button class="btn btn-primary" type="submit">
            Lanjut <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</div>
{{ Form::close() }}
