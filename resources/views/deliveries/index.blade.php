@extends('layouts.app')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <h2>
                        <center>KLP BEVERAGES TRADING</center>
                    </h2>

                </div>
            </div>
            @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
    </div>

    </header><!-- /header -->
    <!-- Header-->



    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="container">

                    <div class="content">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h3 class="m-2 font-weight-bold text-primary">Delivery List&nbsp;
                                    <!-- MODAL for ADDING BEVERAGES-->
                                    <a href="#myModal" role="button" class="btn btn-md btn-primary"
                                        data-bs-toggle="modal"><i class="fas fa-fw fa-plus"></i>Add</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="/deliveries" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                            <label>Date Start</label>
                                                <input type="date" class="form-control"
                                                value="{{ $request->date_start ?? '' }}"
                                                placeholder="Date Start" name="date_start">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Date End</label>
                                                <input type="date" class="form-control" 
                                                value="{{ $request->date_end ?? '' }}"
                                                 placeholder="Date Start" name="date_end">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-md btn-primary">Filter</button>
                                    <a type="button" href="{{route('delivery.export', [
                                        'date_end' => $request->date_end ?? '',
                                        'date_start' => $request->date_start ?? '',
                                        'delivery_ids' => json_encode($delivery_ids)
                                        ])}}" 
                                        target="_blank" class="btn btn-md btn-primary">Export</a>
                                </form>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <h4>Total Deliveries: {{ $deliveries->count() }}</h4>
                                            <h4>Total Cost: &#x20B1;{{ number_format($deliveries->sum('price'), 2) }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="userTable" class="table">
                                        <thead>
                                            <th>OR Number</th>
                                            <th>Beverages Name</th>
                                            <th>Supplier</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Expiry Date</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($deliveries as $delivery)
                                                <tr class="{{ $delivery->date_expire < now() ? 'text-danger' : ''}}">
                                                    <td>{{ $delivery->or_number }}</td>
                                                    <td>{{ $delivery->product->beverage_name }}</td>
                                                    <td>{{ $delivery->supplier->name }}</td>
                                                    <td>{{ $delivery->quantity }}</td>
                                                    <td>&#x20B1;{{number_format($delivery->price, 2)}}</td>
                                                    <td>{{ $delivery->product->category->cat_name ?? 'N/A' }}</td>
                                                    <td>{{ $delivery->date_expire }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- .animated -->
        </div><!-- .content -->

        <!-- .animated -->
    </div><!-- .content -->

    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delivery Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body">
                    {!! Form::open(['action' => 'DeliveryController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        <label>OR Number</label>
                        <input class="form-control" placeholder="OR number" type="text" name="or_number" required>
                    </div>
                    <div class="form-group">
                        <label>Supplier's Name</label>
                        <select name="supplier_id" class="custom-select form-control">
                            <option selected>Choose...</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- select category for beverages --}}
                    {{-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Category</label>
                        </div>
                        <select name="category_id" class="custom-select ">
                            <option selected>Choose...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                            @endforeach
                        </select>
                    </div> --}} 

                    <div class="form-group">
                        <label>Product</label>
                        <select name="product_id" class="custom-select form-control">
                            <option selected>Choose...</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->beverage_name.'['.$product->category->cat_name.']' }}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="form-group">
                        <label>Quantity</label>
                        <input class="form-control" placeholder="Quantity" type="number" name="quantity" required>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input class="form-control" placeholder="Supplier Price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label>Expiry date</label>
                        <input type="date" class="form-control" placeholder="Date Expiry" name="date_expire" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
