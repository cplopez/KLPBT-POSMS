@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['SuppliersController@update', $supplier->id], 'method' => 'POST']) !!}
    <div class="form-group">
        <input class="form-control" placeholder="Supplier's Name" name="name" value="{{$supplier->name}}" required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Address" name="address" value="{{$supplier->address}}" required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Contact Number" name="number" value="{{$supplier->number}}" required>
    </div>

    </div>
    <div class="modal-footer">
        <a href="\suppliers" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary" name="save">Update</button>
    </div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection