@extends('layouts.app')
@section('content')

    <a href="/customers" class="btn btn-primary">Back</a>
    <h1>Customer Name: {{ $customer->name }}</h1>
    <p>Customer Address: {{ $customer->address }}</p>
    <p>Phone Number: {{ $customer->contact }}</p>

    @if (!Auth::guest())
        @if (!Auth::user()->id == $customer->user_id)
            {!! Form::open(['action' => ['CustomersController@destroy', $customer->id], 'method' => 'POST']) !!}
            {{ Form::hidden('_method', 'DELETE') }}
            {!! Form::close() !!}
        @endif
    @endif
@endsection
