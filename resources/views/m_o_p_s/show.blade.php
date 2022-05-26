@extends('layouts.app')
@section('content')
    <a href="/categories" class="btn btn-primary">Back</a>
    <h4>Mode of Payment: {{ $mop->mode }}</h4>
    <p>Created At_: {{ $mop->created_at }}</p>
    <p>Updated at_: {{ $mop->updated_at }}</p>

    @if (!Auth::guest())
        @if (!Auth::user()->id == $mop->user_id)
            {!! Form::open(['action' => ['ModeofPaymentController@destroy', $mop->id], 'method' => 'POST']) !!}
            {{ Form::hidden('_method', 'DELETE') }}
            {{-- <button type="submit" class="btn btn-danger">Delete</button> --}}
            {!! Form::close() !!}
        @endif
    @endif

@endsection
