@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['CategoriesController@update', $category->id], 'method' => 'POST']) !!}
    <div class="modal-body">
        {!! Form::open(['action' => 'CategoriesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            <input class="form-control" placeholder="Category Name" name="cat_name" value="{{$category->cat_name}}" required>
        </div>
    </div>
    <div class="modal-footer">
        <a href="/categories" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary" name="save">Update</button>
    </div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
