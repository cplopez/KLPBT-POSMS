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
                    <h2>
                        <center>KLP BEVERAGES TRADING</center>
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

                    <div class="content">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h3 class="m-2 font-weight-bold text-primary">Beverages List&nbsp;
                                    <!-- MODAL for ADDING BEVERAGES-->
                                    <a href="#myModal" role="button" class="btn btn-md btn-primary"
                                        data-bs-toggle="modal"><i class="fas fa-fw fa-plus"></i>Add</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="userTable" class="table">
                                        <thead>

                                            <th>Beverages Name</th>
                                            <th>Supplier</th>
                                            <th>Cases</th>
                                            <th>Price per Case</th>
                                            <th>Price per Solo</th>
                                            <th colspan="2">Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($beverages as $beverage)
                                                <tr class="text-center">
                                                    <td>{{ $beverage->product->beverage_name }}</td>
                                                    <td>{{ $beverage->supplier->name }}</td>
                                                    <td>{{ $beverage->product->total_quantity }}</td>
                                                    <td>{{ $beverage->product->price_case }}</td>
                                                    <td>{{ $beverage->product->price_solo }}</td>
                                                    <td class="align-middle">
                                                        <a href="/beverages_list/{{ $beverage->id }}"
                                                            class="btn btn-primary mx-2" data-toggle="tooltip"
                                                            data-original-title="Edit user">
                                                            View
                                                        </a>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="/beverages_list/{{ $beverage->id }}/edit"
                                                            class="btn btn-primary mx-2" data-toggle="tooltip"
                                                            data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
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
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Beverage Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'BeveragesListsController@store', 'method' => 'POST']) !!}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Supplier's Name</label>
                        </div>
                        <select name="supplier_id" class="custom-select" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" type="radio" onclick="yesnoCheck();"
                                        name="yesno" value="isExisting" id="yesCheck" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Existing Product
                                    </label>
                                </div>
                                <select name="product_id" class="custom-select"  id="existingProduct" style="display: block">
                                    <option selected>Choose...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->beverage_name }}">{{ $product->beverage_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" onclick="yesnoCheck();" name="yesno"
                                        value="isAdd" id="noCheck">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Add New Product
                                    </label>
                                </div>
                                    <div class="form-group" id="addNewProduct" style="display: none;" >
                                          <input class="form-control" placeholder="Existing Product" name="newBeverageName">
                                </div>
                            </div>

                        </div>
                    </div> 


                </div>

                {{-- select category for beverages --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Category Name</label>
                    </div>
                    <select name="category_id" class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        @foreach ($category as $category)
                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endforeach
                    </select>
                </div> 

                <!--  <div class="form-group">
                                                <input class="form-control" placeholder="Category" name="cat_name" required>
                                            </div> -->
                <div class="form-group">
                    <input class="form-control" placeholder="Quantity" type="" name="quantity" required>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Price per Case" name="price_case" required>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Price per Solo" name="price_solo" required>
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="Date Expiry" name="date_expiry" required>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="Bad Order" name="badorder" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="save">Add</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    </html>

    <script type="text/javascript">
        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('addNewProduct').style.display = 'none';
                document.getElementById('existingProduct').style.display = 'block';
            } else {
                document.getElementById('existingProduct').style.display = 'none';
                document.getElementById('addNewProduct').style.display = 'block';
            }
        }
    </script>

    <!-- Right Panel -->



    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
@endsection
