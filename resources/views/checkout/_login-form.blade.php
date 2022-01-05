{{ Form::open(['route' => 'checkout.post', 'method' => 'POST']) }}
<div class="form-group row">
    {{ Form::label('email', 'Email', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6">
        {{ Form::text('email', null, ['id' => 'email', 'class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : '')]) }}
        {!! $errors->first('email', '<div id="email" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6 offset-md-4 radio">
        <p class="display-d is-invalid mb-0 pb-0">
            <label>
                {{ Form::radio('is_guest', 1, true) }} Saya adalah pelanggan baru
            </label>
            <label>
                {{ Form::radio('is_guest', 0) }} Saya adalah pelanggan tetap
            </label>
        </p>
        {!! $errors->first('is_guest', '<div id="is_guest" class="invalid-feedback mt-0 pt-0">:message</div>') !!}
    </div>
</div>
<div class="form-group row">
    {{ Form::label('checkout_password', 'Password', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6">
        {{ Form::password('checkout_password', ['id' => 'checkout_password', 'class' => 'form-control ' . ($errors->has('checkout_password') ? 'is-invalid' : '')]) }}
        {!! $errors->first('checkout_password', '<div id="checkout_password" class="invalid-feedback">:message</div>') !!}
        <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6 offset-md-4 radio">
        <button class="btn btn-primary" type="submit">
            Lanjut <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</div>
{{ Form::close() }}
