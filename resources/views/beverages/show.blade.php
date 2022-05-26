@extends('layouts.app')
@section('content')
    <a href="/beverages_list" class="btn btn-primary">Back</a>
    <h1>Beverages Name: {{ $beverages->product->beverage_name }}</h1>
    <h3>Supplier Address: {{ $beverages->supplier->name }}</h3>
    <p>Category: {{ $beverages->category->cat_name }}</p>
    <p>Quantity: {{ $beverages->product->total_quantity }}</p>
    <p>Price Case: {{ $beverages->product->price_case }}</p>
    <p>Price Solo: {{ $beverages->product->price_solo }}</p>
    <p>Expiration Date: {{ $beverages->product->date_expire }}</p>


    @if (!Auth::guest())
        @if (!Auth::user()->id == $beverages->user_id)
            {!! Form::open(['action' => ['BeveragesListsController@destroy', $beverages->id], 'method' => 'POST']) !!}
            {{ Form::hidden('_method', 'DELETE') }}
            {!! Form::close() !!}
        @endif
    @endif
@endsection
