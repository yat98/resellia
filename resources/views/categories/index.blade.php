@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Category</h3>
                {{ Form::open(['route' => 'categories.index', 'method' => 'GET']) }}
                <div class="form-group mr-1 my-4">
                    {{ Form::text('q', request()->q, ['id' => 'q', 'class' => 'form-control ' . ($errors->has('q') ? 'is-invalid' : ''), 'placeholder' => 'Type category...']) }}
                    {!! $errors->first('q', '<div id="q" class="invalid-feedback">:message</div>') !!}
                </div>
                {{ Form::close() }}
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Title</td>
                            <td>Parent</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->parent ? $category->parent->title : '' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td rowspan="2">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
