@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['BeveragesListsController@update', $beverages->id], 'method' => 'POST']) !!}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Supplier's Name</label>
        </div>
        <select name="supplier_id" class="custom-select" id="inputGroupSelect01">
            @if (!is_null($beverages->supplier))
                <option selected value="{{$beverages->supplier->id}}">{{$beverages->supplier->name}}</option>
            @endif

            @foreach ($suppliers as $supplier)
            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Beverages Name" value="{{$beverages->product->beverage_name}}" name="beverage_name" required>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Category Name</label>
        </div>
    <select name="category_id" class="custom-select" id="inputGroupSelect01">
        @if (!is_null($beverages->category))
            <option selected value="{{$beverages->category->id}}">{{$beverages->category->cat_name}}</option>
        @endif
      @foreach ($category as $category)
      <option value="{{$category->id}}">{{$category->cat_name}}</option>
      @endforeach
  </select>
    </div>
 
    <div class="form-group">
        <input class="form-control" placeholder="Quantity" name="quantity" value="{{$beverages->product->total_quantity}}"  required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Price per Case" name="price_case" value="{{$beverages->product->price_case}}"  required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Price per Solo" name="price_solo" value="{{$beverages->product->price_solo}}" required>
    </div>
    <div class="form-group">
        <input type="date" class="form-control" placeholder="Date Expiry" name="date_expire"  value="{{$beverages->product->date_expire}}" required>
    </div>
    <div class="form-group">
        <input type ="number"class="form-control" placeholder="Bad Order"  name="badorder" value="{{$beverages->product->badorder}}" required>
    </div>
   

</div>
<div class="modal-footer">
    <a href="/beverages_list" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary" name="save">Update</button>
</div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
