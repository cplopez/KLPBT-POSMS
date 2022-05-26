@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['CustomerSalesController@update', $customerSale->id], 'method' => 'POST']) !!}
    <div class="modal-body">
    {!! Form::open(['action' => 'CustomerSalesController@store', 'method' => 'POST']) !!}
        <div class="form-group">

        <input class="form-control" placeholder="Customer's Name" name="customer_name"
            value="{{ $customerSale->customer->name }}" required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Mode of Payment" name="m_o_p_id" value="{{ $customerSale->m_o_p->mode }}"
            required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Amount" name="amount" value="{{ $customerSale->amount }}" required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Check No." name="check_num" value="{{ $customerSale->check_num }}"
            required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Mode of Payment" name="check_date" value="{{ $customerSale->check_date }}"
            required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Amount" name="amount" value="{{ $customerSale->amount }}" required>
    </div>
    </div>
    <div class="modal-footer">
        <a href="/customersales" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary" name="save">Update</button>
    </div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
