@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Category
                    <small>
                        <a href="{{ route('categories.create') }}" class="btn btn-warning btn-sm btn-icon ml-2">
                            <i class="fas fa-tags"></i>
                            New Category
                        </a>
                    </small>
                </h3>
                {{ Form::open(['route' => 'categories.index', 'method' => 'GET']) }}
                <div class="form-group mr-1 my-4">
                    {{ Form::text('q', request()->q, ['id' => 'q', 'class' => 'form-control ' . ($errors->has('q') ? 'is-invalid' : ''), 'placeholder' => 'Type category...']) }}
                    {!! $errors->first('q', '<div id="q" class="invalid-feedback">:message</div>') !!}
                </div>
                {{ Form::close() }}
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Parent</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->parent ? $category->parent->title : '' }}</td>
                                <td>
                                    {{ Form::model($category, ['route' => ['categories.destroy', $category], 'method' => 'DELETE']) }}
                                    <a href="{{ route('categories.edit', $category) }}">Edit</a> |
                                    {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger js-submit-confirm']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
