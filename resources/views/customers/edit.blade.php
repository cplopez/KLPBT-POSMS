@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['CustomersController@update', $customer->id], 'method' => 'POST']) !!}
    <div class="form-group">
        <input class="form-control" placeholder="Customer's Name" name="name" value="{{$customer->name}}" required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Address" name="address" value="{{$customer->address}}" required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Contact Number" name="contact" value="{{$customer->contact}}" required>
    </div>

    </div>
    <div class="modal-footer">
        <a href="\customers" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary" name="save">Update</button>
    </div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
