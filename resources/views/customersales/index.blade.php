@extends('layouts.app')
@section('content')
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <title tyle="color:red;font-size:60px;">
      KLP POS Monitoring System
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
      <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.3')}}" rel="stylesheet" />
  </head>
  
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <h3 class="m-2 font-weight-bold text-primary">
                        <center>Customer Sales  and Account Payables</center>
                    </h3>

                </div>
                </div>
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
                                    <h4 class="m-2 font-weight-bold text-primary">Data from Sales&nbsp;
                                        <!-- MODAL for ADDING BEVERAGES-->
                                        {{-- <a href="#myModal" role="button" class="btn btn-md btn-primary"
                                            data-bs-toggle="modal"><i class="fas fa-fw fa-plus"></i>Add</a> --}}
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="/customer_sales" method="GET">
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
                                        <!-- <button type="button" id="export" class="btn btn-md btn-primary">Export</button> -->
                                    </form>
                                    <div class="table-responsive">
                                        <table id="userTable" class="table">
                                            <thead>

                                                {{-- <th>id</th> --}}
                                                <th>Customer Name</th>
                                                <th>Mode of Payment</th>
                                                <th>Amount Due</th>
                                                <!-- <th>Check No.</th>
                                                <th>Check Date</th>
                                                <th>Bank Name</th> -->
                                                <th>Discount</th>
                                                <!-- <th>Check Amount</th> -->
                                                <th>Total Quantity</th>
                                                <th>Total Cash</th> 
                                                <!-- <th colspan="2"><center>Actions</center></th> -->
                                            </thead>
                                            <tbody> 
                                                @foreach ($customerSale as $customer_sale)
                                                    <tr class="text-center">
                                                        <td>{{$customer_sale->customer->name}}</td>
                                                        <td>{{$customer_sale->m_o_p->mode}}</td>
                                                        <td>{{$customer_sale->amount}}</td>
                                                        <!-- <td>{{$customer_sale->check_num}}</td>
                                                        <td>{{$customer_sale->check_date}}</td>
                                                        <td>{{$customer_sale->bankname}}</td> -->
                                                        <td>{{$customer_sale->discount}}</td>
                                                        <!-- <td>{{$customer_sale->check_amount}}</td> -->
                                                        <td>{{$customer_sale->total_quantity}}</td>
                                                        <td>{{$customer_sale->total_cash}}</td>
                                                        {{-- <td class="align-middle">
                                                            <a href="/customer_sales/{{$customer_sale->id}}"
                                                                class="btn btn-primary mx-2" data-toggle="tooltip"
                                                                data-original-title="Edit user">
                                                                View
                                                            </a>
                                                        </td> --}}
                                                        {{-- <td class="align-middle">
                                                            <a href="/customer_sales/{{$customer_sale->id}}/edit"
                                                                class="btn btn-primary mx-2" data-toggle="tooltip"
                                                                data-original-title="Edit user">
                                                                Edit
                                                            </a>
                                                        </td> --}}
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
        <!--/.col-->
        <script>
            $("#export").click(function() {
                    var divToPrint=document.getElementById('userTable');

                    var newWin=window.open('','Print-Window');

                    newWin.document.open();

                    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

                    newWin.document.close();

                    setTimeout(function(){newWin.close();},10);
            })
        </script>
        <!-- Modal HTML -->
        {{-- <div id="myModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Customer Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['action' => 'CustomerSalesController@store', 'method' => 'POST']) !!}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Supplier's Name</label>
                            </div>
                            <select name="supplier_id" class="custom-select" id="inputGroupSelect01">
                                <option selected>Choose...</option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Beverages Name" name="p_name" required>
                        </div>
                        <select name="category_id" class="custom-select" id="inputGroupSelect01">
                          <option selected>Select Category</option>
                          @foreach ($category as $category)
                          <option value="{{$category->id}}">{{$category->cat_name}}</option>
                          @endforeach
                      </select>
                      <!--  <div class="form-group">
                            <input class="form-control" placeholder="Category" name="cat_name" required>
                        </div> -->
                        <div class="form-group">
                            <input class="form-control" placeholder="Quantity" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Price per Case" name="price_case" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Price per Solo" name="price_solo" required>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" placeholder="Date Expiry" name="date_expire" required>
                        </div>
                        <div class="form-group">
                            <input type ="number"class="form-control" placeholder="Bad Order" name="badorder" required>
                        </div>
                       

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="save">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div> --}}

        </html>
    @endsection
