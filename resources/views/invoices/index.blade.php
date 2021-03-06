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
        @if (session()->has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif 
        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                    <style>
        .input-icon {
                position: relative;
                }

                .input-icon > i {
                position: absolute;
                display: block;
                transform: translate(0, -50%);
                top: 50%;
                pointer-events: none;
                width: 25px;
                text-align: center;
                    font-style: normal;
                }

                .input-icon > input {
                padding-left: 25px;
                    padding-right: 0;
                }

                .input-icon-right > i {
                right: 0;
                }

                .input-icon-right > input {
                padding-left: 0;
                padding-right: 25px;
                text-align: right;
                }
    </style>
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
                            <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="submit" class="mb-0 btn btn-outline-secondary">Search Beverage</button>
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
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Beverage Name</label>
                                        <select name="product_id" class="custom-select form-control" id="product">
                                            <option value="">Select Beverage</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" quantity="{{$product->total_quantity}}">
                                                    {{ $product->beverage_name.' ['.$product->category->cat_name.']' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Quantity (Cases) Left</label>
                                        <input readonly type="number" id="quantity_left" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Quantity (Cases)</label>
                                        <input type="number" name="quantity" class="form-control">
                                    </div>
                                </div>
                                
                                <input type="hidden" name="order_number" value="{{ $request->order_number ?? '' }}">
                                <button type="submit" class="btn btn-primary">Add Order</button>
                            </div>
                            
                            {!! Form::close() !!}
                        
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="userTable" class="table">
                                        <thead>
                                            <th>Order number</th>
                                            <th>Beverages Name</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchases as $purchase)
                                                <tr>
                                                    <td>{{ $purchase->order_id }}</td>
                                                    <td>{{ $purchase->product->beverage_name.' ['.$product->category->cat_name.']' }}</td>
                                                    <td align="right">{{ $purchase->quantity }}</td>
                                                    <td align="right">{{ number_format($purchase->total, 2) }}</td>
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
                                    <h1>&#8369; {{ number_format($totals, 2) }} </h1>
                                </div>
                            </div>
                            <div class="col-12">
                            <form action="/purchase" method="GET">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button type="submit" class="mb-0 btn btn-outline-secondary">Search Customer</button>
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
                                        <select name="customer_id" class="form-control">
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
                                        <select name="mop_id" class="form-control">
                                            @foreach ($m_o_p_s as $bayadform)
                                                <option value="{{ $bayadform->id }}">
                                                    {{ $bayadform->mode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Discount %</label>
                                        <input type="number" oninput="calcDiscountedAmount()" id="discount" name="discount" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                        <div class="form-group">
                                            <label>Discount Amount</label>
                                                <input readonly type="text" id="discountedAmountString" name="total_cashString" class="form-control" min="1" max="1000000" placeholder="0.00">
                                                <input readonly type="hidden" id="discountedAmount" name="total_cash" class="form-control" min="1" max="1000000">
                                        </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Cash</label>
                                        <div class="input-icon">
                                        <input type="number" oninput="calcChange()" id="cash" name="cash"  class="form-control">
                                        <i>???</i>
                                        </div>  
                                        <input type="hidden" id="amountDue" name="amount" value="{{ $totals, 2 }}" readonly  class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Change</label>
                                        <input type="hidden" readonly oninput="calcChange()" id="change" name="change" class="form-control">
                                        <input type="text" readonly oninput="calcChange()" id="changeString" name="change" class="form-control" placeholder="0.00">
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
        var discountedAmmountNumberFormat = 0;
        var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'PHP',
        });
        function calcDiscountedAmount() {
            var discount = document.getElementById("discount").value;
            var amount_due = document.getElementById("amountDue").value;
            var discountedAmount = parseFloat(amount_due ) * parseInt(discount) / 100;
            discountedAmmountNumberFormat = amount_due - discountedAmount;
            document.getElementById("discountedAmount").value = discountedAmmountNumberFormat.toFixed(2);
            document.getElementById("discountedAmountString").value = formatter.format(discountedAmmountNumberFormat);
        }

        function calcChange() {
            var cash = document.getElementById("cash").value;
            var amount = discountedAmmountNumberFormat;
            var totalAmount = parseInt(cash) - amount;
            document.getElementById("change").value = totalAmount.toFixed(0);
            document.getElementById("changeString").value = formatter.format(totalAmount);
        }
        var products = <?= $products ?>;
        
        $('#product').on('change', function(e){
            var pid = $("#product option").filter(":selected").val();
            
            var product = products.find(p=>p.id == pid);
            document.getElementById("quantity_left").value = product.total_quantity;
        });

       
    </script>


    
@endsection
