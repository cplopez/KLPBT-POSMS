@extends('layouts.app')
@section('content')
  
<div id="right-panel" class="right-panel">

        <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-10">
                <h2 class="text-center">
                    <center>KLP BEVERAGE TRADING</center>
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
    </header><!-- /header -->
    <!-- Header-->


    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="container">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h3 class="m-2 font-weight-bold text-primary">Sales Invoice&nbsp;</h3>
                    </div>
                    <div class="card-body">
                    <form action="/purchase" method="GET">
                        <div class="row">
                        <input type="hidden" value="{{ $request->customer ?? ''}}" class="form-control" name="customer"placeholder="" aria-label="" aria-describedby="basic-addon1">
                            <div class="col-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-outline-secondary">Search Beverage</button>
                                </div>
                                <input type="text" value="{{ $request->beverage ?? ''}}" class="form-control" name="beverage" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                </div>
                                <input type="hidden" name="order_number" value="{{ $request->order_number ?? '' }}">
                            </div>
                        </div>
                    </form>
                    {!! Form::open(['action' => 'PurchasesController@store', 'method' => 'POST']) !!}
                        <div class="row">    
                            <div class="col-12 row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Beverage Name</label>
                                        <select name="product_id" class="custom-select" style="width: 200px;">
                                            <option value="">Select Beverage</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->beverage_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                

                            </div>
                        
                            <div class="col-12 row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <select name="category_id" style="width: 200px;">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->cat_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Quantity (Cases)</label>
                                        <input type="number" name="quantity" style="width: 200px;">
                                    </div>
                                    <input type="hidden" name="order_number" value="{{ $request->order_number ?? '' }}">
                                    <button type="submit" class="btn btn-primary">Add Order</button>
                                </div>
                            </div>
                            
                            {!! Form::close() !!}
                        
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="userTable" class="table">
                                        <thead>
                                            <th>Order number</th>
                                            <th>Beverages Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchases as $purchase)
                                                <tr>
                                                    <td>{{ $purchase->order_id }}</td>
                                                    <td>{{ $purchase->product->beverage_name }}</td>
                                                    <td>{{ $purchase->category->cat_name }}</td>
                                                    <td>{{ $purchase->quantity }}</td>
                                                    <td>{{ $purchase->total }}</td>
                                                    <td>
                                                        <form action="{{ route('purchases.destroy', [$purchase->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            
                            <div class="col-12">
                                <div class="form-group">
                                    <h3>Grand Total</h3>
                                    <h1>&#8369; {{$totals}}</h1>
                                </div>
                            </div>
                            <div class="col-12">
                            <form action="/purchase" method="GET">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button type="submit" class="btn btn-outline-secondary">Search Customer</button>
                                            </div>
                                            <input type="hidden" value="{{ $request->beverage ?? ''}}" class="form-control" name="beverage" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                            <input type="hidden" name="order_number" value="{{ $request->order_number ?? '' }}">
                                            <input type="text" value="{{ $request->customer ?? ''}}" class="form-control" name="customer"placeholder="" aria-label="" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                            <form action="{{ route('customer_sales.store', ['order_number' => $request->order_number]) }}" method="POST">
                                @method('POST')
                                @csrf
                                <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <select name="customer_id" style="width: 200px;">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $request->customer_id == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Mode of Payment</label>
                                        <select name="mop_id" style="width: 200px;">
                                            @foreach ($m_o_p_s as $bayadform)
                                                <option value="{{ $bayadform->id }}">
                                                    {{ $bayadform->mode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                        <div class="form-group">
                                            <label>Amount Due</label>
                                            <input type="number" id="amountDue" name="amount" value="{{ $totals }}" readonly style="width: 200px;">
                                        </div>
                                </div>
                                <div class="col-6">
                                        <div class="form-group">
                                            <label>Discount %</label>
                                            <input type="number" oninput="calcDiscountedAmount()" id="discount" name="discount" style="width: 200px;">
                                        </div>
                                </div>
                                <div class="col-6">
                                        <div class="form-group">
                                            <label>Discount Amount</label>
                                            <input readonly type="number" id="discountedAmount" name="total_cash" style="width: 200px;">
                                        </div>
                                </div>
                                <div class="col-6">
                                        <div class="form-group">
                                            <label>Cash</label>
                                            <input type="number" oninput="calcChange()" id="cash" name="cash" style="width: 200px;">
                                        </div>
                                </div>
                                <div class="col-6">
                                        <div class="form-group">
                                            <label>Change</label>
                                            <input type="number" oninput="calcChange()" id="change" name="change" style="width: 200px;">
                                        </div>
                                </div>
                                <div class="col-12">
                                    <button  class="btn btn-primary">Proceed</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--/.col-->
    <!-- Right Panel -->


    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer's Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'CustomersController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        <input class="form-control" placeholder="Customer's Name" name="name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Address" name="address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Contact Number" name="contact" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="save">Add</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script>
        function calcDiscountedAmount() {
            var discount = document.getElementById("discount").value;
            var amount_due = document.getElementById("amountDue").value;
            var discountedAmount = parseInt(amount_due ) * parseInt(discount) / 100;
            document.getElementById("discountedAmount").value = amount_due - discountedAmount;
        }

        function calcChange() {
            var cash = document.getElementById("cash").value;
            var amount = document.getElementById("discountedAmount").value;
            document.getElementById("change").value = parseInt(cash) - amount;
        }
    </script>
@endsection
