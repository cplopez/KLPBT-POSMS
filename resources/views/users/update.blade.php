@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'POST']) !!}
    <div class="form-group">
        <input class="form-control" placeholder="User's Name" name="name" value="{{$user->name}}" required>
    </div>
    </div>
    <div class="modal-footer">
        <a href="\users" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary" name="save">Update</button>
    </div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
