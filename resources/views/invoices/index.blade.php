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

                <div class="col-sm-10">
                    <h2 class="text-center">
                        <center>KLP BEVERAGE TRADING</center>
                    </h2>

                </div>

            </div>
    </div>

    </header><!-- /header -->
    <!-- Header-->


    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="container">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-2 font-weight-bold text-primary">Sales Invoice&nbsp;</h3>
                        </div>

                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="table-responsive">
 
                                    <table class="table " id="dataTable" width="100%" cellspacing="0">
                                        <tr>
                                            <td>
                                                <!-- Table 1 -->
                                                {!! Form::open(['action' => 'PurchasesController@store', 'method' => 'POST']) !!}

                                                <input type="hidden" name="orderID" value="">
                                                <table>

                                                    <tr>
                                                        <td>
                                                            <label>Beverage Name</label>
                                                        <td colspan="2">
                                                            <select name="beverage" style="width: 200px;">
                                                                @if (count($beverages) > 0)
                                                                    @foreach ($beverages as $beverages)
                                                                        <option value="{{ $beverages->id }}">
                                                                            {{ $beverages->product->beverage_name }}
                                                                        </option>
                                                                    @endforeach
                                                                    <option disabled selected>-- Select Beverage --
                                                                    </option>
                                                                @else
                                                                    <option disabled selected>-- Select Beverage --
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </td>
                                                        </select>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <label>Category Name</label>
                                            <td colspan="2">
                                                <select name="category" style="width: 200px;">
                                                    @if (count($categories) > 0)
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->cat_name }}
                                                            </option>
                                                        @endforeach
                                                        <option disabled selected>-- Select Category --
                                                        </option>
                                                    @else
                                                        <option disabled selected>-- Select Category --
                                                        </option>
                                                    @endif
                                                </select>
                                            </td>
                                            </select>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <label>Quantity(Cases)</label>
                                            </td>
                                            <td>
                                                <input type="text" name="case" style="width: 200px;">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <button type="submit" class="btn btn-primary" name="save">Add</button>
                                                
                                            </td>
                                        </tr>

                                        </tr>
                                    </table>
                                    {!! Form::close() !!}
                                    <!-- end of Table 1 -->
                                    </td>
                                    </tr>
                                    </table>
                                </div>

                                <div class="container">

                                    <div class="card-header py-3">
                                        <h4 class="m-2 font-weight-bold text-primary">Purchase Details&nbsp;</h4>
                                    </div>

                                    <table class="table " id="Datatables" width="100%" cellspacing="0">
                                        <tr>
                                            <td>
                                                <!-- Table 1 -->
                                                <table>
                                                    <tr>
                                                        <th>Beverage Name</th>
                                                        <th>Category</th>
                                                        <th>Quantity (Case)</th>
                                                        <th>Price Per Case</th>
                                                        <th>Price Per Solo</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>

                                                    @foreach ($purchases as $purchase)
                                                        <tr>
                                                            <td>{{ $purchase->beverage->product->beverage_name }}</td>
                                                            <td>{{ $purchase->category->cat_name }}</td>
                                                            <td>{{ $purchase->quantity }}</td>
                                                            <td>{{ $purchase->beverage->product->price_case }}</td>
                                                            <td>{{ $purchase->beverage->product->price_solo }}</td>
                                                            <td>{{ $purchase->total }}</td>
                                                            <td><a href="SalesInvoiceController@destroy?delete=<php echo $row['pur_id']; ?>"
                                                                    class="btn btn-danger" style="width: 90px;">Cancel</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach



                                                    {{-- <php //endwhile;
                                                        ?> --}}


                                                </table>
                                                <!-- end of Table 1 -->
                                            </td>



                                            <td>
                                                <table border="1">

                                                    <!-- Table 2 -->
                                                    <tr>
                                                        <th colspan="2">Customer Name</th>
                                                    </tr>
                                                    <tr>
                                                        <form action="purchased/0" method="GET">
                                                            <td colspan="2">
                                                                <select name="customer" style="width: 200px;">
                                                                    @if (count($customers) > 0)
                                                                        @foreach ($customers as $customer)
                                                                            <option value="{{ $customer->id }}">
                                                                                {{ $customer->name }}</option>
                                                                        @endforeach
                                                                        <option disabled selected>-- Select Customer --
                                                                        </option>
                                                                    @else
                                                                        <option disabled selected>-- Select Customer --
                                                                        </option>
                                                                    @endif
                                                                </select>
                                                                <a href="#myModal" role="button"
                                                                    class="btn btn-md btn-primary" data-bs-toggle="modal"
                                                                    class=""></i>ADD</a>
                                                            </td>
                                                    </tr>

                                                    <tr>
                                                        <th colspan="2">Mode of Payment</th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <select name="mop" style="width: 200px;">
                                                                @if (count($m_o_p_s) > 0)
                                                                    @foreach ($m_o_p_s as $bayadform)
                                                                        <option value="{{ $bayadform->id }}">
                                                                            {{ $bayadform->mode }}</option>
                                                                    @endforeach
                                                                    <option disabled selected>-- Select Payment --
                                                                    </option>
                                                                @else
                                                                    <option disabled selected>-- Select Payment --
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th colspan="2">Summary</th>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <label>Grand Total</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" border="none" value="{{$totals}}"
                                                                name="gtotal" id="txt1" style="width: 200px;" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <button type="submit" class="btn btn-primary"
                                                                style="width: 90px;">
                                                                <center>Proceed</center>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    </form>
                                                </table>
                                                <!-- end of Table 2 -->
                                            </td>


                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div><!-- .animated -->
    </div><!-- .content -->
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
@endsection
