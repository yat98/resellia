<div class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, ['id' => 'title', 'class' => 'form-control ' . ($errors->has('title') ? 'is-invalid' : '')]) }}
    {!! $errors->first('title', '<div id="title" class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('parent_id', 'Parent') }}
    {{ Form::select('parent_id', $parents, null, ['id' => 'parent_id', 'class' => 'form-control ' . ($errors->has('parent_id') ? 'is-invalid' : '')]) }}
    {!! $errors->first('parent_id', '<div id="parent_id" class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::submit(isset($category) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) }}
</div>
