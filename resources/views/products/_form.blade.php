<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : '')]) }}
    {!! $errors->first('name', '<div id="name" class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('model', 'Model') }}
    {{ Form::text('model', null, ['id' => 'model', 'class' => 'form-control ' . ($errors->has('model') ? 'is-invalid' : '')]) }}
    {!! $errors->first('model', '<div id="model" class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('price', 'Price') }}
    {{ Form::text('price', null, ['id' => 'price', 'class' => 'form-control ' . ($errors->has('price') ? 'is-invalid' : '')]) }}
    {!! $errors->first('price', '<div id="price" class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('categories', 'Categories') }}
    {{ Form::select('categories[]', $categories, null, ['id' => 'categories', 'class' => 'form-control js-selectize ' . ($errors->has('categories') ? 'is-invalid' : ''), 'multiple' => 'multiple', 'autocomplete' => 'off']) }}
    {!! $errors->first('categories', '<div id="categories" class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('photo', 'Photo (jpeg, png)') }}
    <div class="custom-file">
        {{ Form::file('photo', ['id' => 'custom-file-upload', 'class' => 'custom-file-input ' . ($errors->has('categories') ? 'is-invalid' : '')]) }}
        {{ Form::label('custom-file-upload', 'Pilih file', ['class' => 'custom-file-label']) }}
        {!! $errors->first('photo', '<div id="categories" class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="form-group">
    {{ Form::submit(isset($category) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}
</div>
