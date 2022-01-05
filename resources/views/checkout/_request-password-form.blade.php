{{ Form::open(['route' => ['password.email'], 'method' => 'POST']) }}
<div class="form-group row text-center">
    {{ Form::label('email', 'Email', ['class' => 'col-md-4 col-form-label']) }}
    <div class="col-md-6">
        {{ Form::text('email', session()->has('email') ? session('email') : null, ['id' => 'email', 'class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : '')]) }}
        {!! $errors->first('email', '<div id="email" class="invalid-feedback">:message</div>') !!}
        <small class="form-text text-muted text-left">Nampaknya Anda pernah berbelanja di {{ config('app.name') }}.
            Klik "Kirim
            petunjuk"
            untuk meminta password baru</small>
    </div>
</div>
<div class="form-group">
    <div class="offset-md-4 pl-sm-2">
        <button type="submit" class="btn btn-primary">
            Kirim petunjuk <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</div>
{{ Form::close() }}
