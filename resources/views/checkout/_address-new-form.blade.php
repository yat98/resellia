{{ Form::open(['route' => ['checkout.post-address'], 'method' => 'post']) }}
@include('checkout._address-field')
<div class="form-group text-left">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            Lanjut <i class="fa fa-arrow-right"></i>
        </button>
    </div>
</div>
{{ Form::close() }}
