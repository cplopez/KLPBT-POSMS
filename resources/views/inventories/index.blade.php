@extends('layouts.app')
@section('content')

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
        <title tyle="color:red;font-size:60px;">
            KLP POS Monitoring System
        </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
    </head>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-10">
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
                                <h3 class="m-2 font-weight-bold text-primary">Inventories&nbsp;
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="userTable" class="table">
                                        <thead>
                                            <th>Beverages Information</th>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    @if (count($inventories) > 0)
                                                        <table class="table table-bordered data-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Product Name</th>
                                                                    <th>Category Name</th>
                                                                    <th>Quantity </th>
                                                                    <th>Price per Case </th>
                                                                    <th>Price per Solo </th>
                                                                    <th>Date of Expiry</th>
                                                                    <th>Bad Order</th>

                                                            </thead>
                                                            <tbody>
                                                                @foreach ($inventories as $inventory)
                                                                    <tr>
                                                                        <td>{{ $inventory->id }}</td>
                                                                        <td>{{ $inventory->product->beverage_name }}</td>
                                                                        <td>{{ $inventory->category->cat_name }}</td>
                                                                        <td>{{ $inventory->product->total_quantity }}</td>
                                                                        <td>{{ $inventory->product->price_case }}</td>
                                                                        <td>{{ $inventory->product->price_solo }}</td>
                                                                        <td>{{ $inventory->product->date_expire }}</td>
                                                                        <td>{{ $inventory->product->badorder }}</td>

                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                </div>
                                                @else
                                                <h1>No Inventories Information Available.</h1>
                                                @endif
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
            

            </html>

        @endsection
