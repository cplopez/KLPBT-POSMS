@extends('layouts.app')
@section('content')
    {!! Form::open(['action' => ['BeveragesListsController@update', $inventories->id], 'method' => 'POST']) !!}
    
    <div class="form-group">
        <input class="form-control" placeholder="Beverages Name" value="{{$inventory->product_name}}" name="p_name" required>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Category Name</label>
        </div>
    <select name="category_id" class="custom-select" id="inputGroupSelect01">
        @if (!is_null($inventories->inventory))
            <option selected value="{{$inventory->category->id}}">{{$inventory->category->cat_name}}</option>
        @endif
      @foreach ($category as $category)
      <option value="{{$category->id}}">{{$category->cat_name}}</option>
      @endforeach
  </select>
    </div>
 
    <div class="form-group">
        <input class="form-control" placeholder="Quantity" value="{{$inventory->quantity}}" name="quantity" required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Price per Case" value="{{$inventory->price_case}}" name="price_case" required>
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="Price per Solo" value="{{$inventory->price_solo}}" name="price_solo" required>
    </div>
    <div class="form-group">
        <input type="date" class="form-control" placeholder="Date Expiry" value="{{$inventory->date_expire}}" name="date_expire" required>
    </div>
    <div class="form-group">
        <input type ="number"class="form-control" placeholder="Bad Order" value="{{$inventory->barorder}}" name="badorder" required>
    </div>
   

</div>
<div class="modal-footer">
    <a href="/inventories" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary" name="save">Update</button>
</div>
    <input type="hidden" name="_method" value="PUT">
    {!! Form::close() !!}
@endsection
