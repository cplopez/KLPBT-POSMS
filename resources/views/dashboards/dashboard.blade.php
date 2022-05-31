
   
@extends('layouts.app')
@section('content')

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">
            <h2>
                Welcome
            </h2>
            <div class="col-sm-10">
                <h1>
                    <center>KLP BEVERAGES TRADING</center>
                </h1>
            </div>
            </div>
        </div>

    </header>
    {{-- END OF HEADER --}}
    {{-- FOR SALES --}}
    
    <div class="container-fluid py-6 align-items-sm-center">
        <div class="justify-content-center d-flex row">
           
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold ">Customer's </p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{count($customers)}}
                                        <span class="text-success text-sm font-weight-bolder"></span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-10 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Suppliers</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{count($suppliers)}}
                                        {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-10 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
   
            <div class="container-fluid py-4">
                <div class="justify-content-center d-flex row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Beverages Lists</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{count($beverages)}}
                                        {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-10 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Categories</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{count($categories)}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-10 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <h4 class="text-center">DELIVERIES</h4>
                                <table id="userTable" class="table">
                                    <thead>
                                        <th>OR Number</th>
                                        <th>Beverages Name</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        <th>Quantity Left</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Expiry Date</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($deliveries as $delivery)
                                            <tr class="{{ ($delivery->date_expire < now() && $delivery->new_quantity > 0) ? 'text-danger' : ''}}">
                                                <td>{{ $delivery->or_number }}</td>
                                                <td>{{ $delivery->product->beverage_name }}</td>
                                                <td>{{ $delivery->supplier->name }}</td>
                                                <td>{{ $delivery->quantity }}</td>
                                                <td>{{ $delivery->new_quantity }}</td>
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
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <h4 class="text-center">Customer Sales</h4>
                                <table id="userTable" class="table">
                                    <thead>
                                        <th>Customer Name</th>
                                        <th>Mode of Payment</th>
                                        <th>Amount Due</th>
                                        <th>Discount</th>
                                        <th>Total Quantity</th>
                                        <th>Total Cash</th> 
                                        <th>Date</th>
                                    </thead>
                                    <tbody> 
                                        @foreach ($customerSale as $customer_sale)
                                            <tr class="text-center">
                                                <td>{{$customer_sale->customer->name}}</td>
                                                <td>{{$customer_sale->m_o_p->mode}}</td>
                                                <td>&#x20B1;{{number_format($customer_sale->amount, 2)}}</td>
                                                <td>{{$customer_sale->discount}}</td>
                                                <td>{{$customer_sale->total_quantity}}</td>
                                                <td>&#x20B1;{{ number_format($customer_sale->total_cash, 2)}}</td>
                                                <td>{{$customer_sale->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <h4 class="text-center">Inventories</h4>
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product Name</th>
                                            <th>Category Name</th>
                                            <th>Old Quantity</th>
                                            <th>New Quantity</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                    </thead>
                                    <tbody>
                                        @foreach($inventories as $i => $inventory)
                                            <tr class="{{ ($inventory->badorder == 1) ? 'text-danger' : ''}}">
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $inventory->product->beverage_name }}</td>
                                                <td>{{ $inventory->product->category->cat_name}}</td>
                                                <td>{{ $inventory->old_quantity}}</td>
                                                <td>{{ $inventory->new_quantity}}</td>
                                                <td>{{ $inventory->quantity}}</td>
                                                <td>{{ $inventory->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

@endsection