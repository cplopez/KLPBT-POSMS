@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['ModeofPaymentController@update', $mop->id], 'method' => 'POST']) !!}
    <div class="modal-body">
        <div class="form-group">
            <input class="form-control" placeholder="Category Name" name="mode" value="{{$mop->mode}}" required>
        </div>
    </div>
    <div class="modal-footer">
        <a href="/mops" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary" name="save">Update</button>
    </div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
