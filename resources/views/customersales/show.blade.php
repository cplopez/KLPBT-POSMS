@extends('layouts.app')
@section('content')
    <a href="/customer_sales" class="btn btn-primary">Back</a>
    <h1>Customer Name: {{$customerSale->customer->name}}</h1>
    <h3>Mode of Payment: {{ $customerSale->m_o_p->mode }}</h3>
    <p>Amount: {{ $customerSale->amount}}</p>
    <p>Quantity: {{$customerSale->check_num}}</p>
    <p>Check Date: {{$customerSale->check_date}}</p>
    <p>Bank Name : {{ $customerSale->bankname}}</p>
    <p>Discount: {{$customerSale->discount}}</p>
    <p>Check Amount: {{$customerSale->check_amount}}</p>
    <p>Cash : {{ $customerSale->total_quantity}}</p>
    <p>Total Cash: {{$customerSale->total_cash}}</p>


    @if (!Auth::guest())
        @if (!Auth::user()->id == $customerSale->user_id)
            {!! Form::open(['action' => ['CustomerSalesController@destroy', $customerSale->id], 'method' => 'POST']) !!}
            {{ Form::hidden('_method', 'DELETE') }}
            {!! Form::close() !!}
        @endif
    @endif
@endsection