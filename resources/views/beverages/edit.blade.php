@extends('layouts.app')
@section('content')
    <div class="modal-content">
        {!! Form::open(['action' => ['ProductController@update', $product->id], 'method' => 'POST']) !!}
        <div class="form-group">
            <input class="form-control" placeholder="Quantity" name="beverage_name" value="{{ $product->beverage_name }}"  required>
        </div> 
    </div> 
    <div class="modal-footer">
        <a href="/beverages_list" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>  
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
