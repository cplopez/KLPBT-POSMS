@extends('layouts.app')
@section('content')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 
    {!! Form::open(['action' => ['DeliveryController@update', $delivery->id], 'method' => 'POST']) !!}
    <div class="form-group">
        <input class="form-control" placeholder="OR number" type="text" name="or_number" value="{{ $delivery->or_number }}" required>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text">Supplier's Name</label>
        </div>
        <select name="supplier_id" class="custom-select">
            @foreach ($suppliers as $supplier)
            <option value="{{$supplier->id}}" {{ $delivery->supplier->id == $supplier->id ? 'selected': '' }}>{{$supplier->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text">Product's Name</label>
        </div>
        <select name="product_id" class="custom-select">
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $delivery->product->id == $product->id ? 'selected': '' }}>{{ $product->beverage_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text">Category Name</label>
        </div>
        <select name="category_id" class="custom-select">
        @foreach ($categories as $category)
        <option value="{{$category->id}}" {{ $delivery->category->id == $category->id ? 'selected': '' }}>{{$category->cat_name}}</option>
        @endforeach
    </select>
    </div>
 
    <div class="form-group">
        <input class="form-control" placeholder="Quantity" name="quantity" value="{{$delivery->quantity}}"  required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Supplier Price" name="price" value="{{$delivery->price}}"  required>
    </div>
    <div class="form-group">
        <input type="date" class="form-control" placeholder="Date Expiry" name="date_expire"  value="{{$delivery->date_expire}}" required>
    </div>
   

</div>
<div class="modal-footer">
    <a href="/deliveries" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Update</button>
</div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
