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
  
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h2>Order's From Suppliers&nbsp;
                        <a href="#myModal" role="button" class="btn btn-md btn-primary" data-bs-toggle="modal"><i
                                class="fas fa-fw fa-plus"></i>Add</a>
                    </h2>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        {!! Form::open(['action' => 'OrderController@store', 'method' => 'POST']) !!}
                        <table class="table align-items-center mb-0">
                            <thead>
                                <th>Order Number</th>
                                <th>Supplier Name</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Beverage Name</th>
                                <th>Category</th>
                                <th>Order's Quantity</th>
                                <th colspan="2">Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $orders)
                                    <tr class="text-center">
                                        <td>{{ $orders->order_number }}</td>
                                        <td>{{ $orders->supplier->name }}</td>
                                        <td>{{ $orders->address }}</td>
                                        <td>{{ $orders->number }}</td>
                                        <td>{{ $orders->product_id }}</td>
                                        <td>{{ $orders->category->cat_name }}</td>
                                        <td>{{ $beverage->quantity }}</td>
                                        
                                        <td class="align-middle">
                                            <a href="/orders/{{ $orders->id }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                View
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/orders/{{ $orders->id }}/edit"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
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

    <!-- Button HTML (to Trigger Modal) -->

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Order Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'OrderController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        <input class="form-control" placeholder="Order Number" name="order_number" required>
                    </div>
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
                    <div class="form-group">
                        <input class="form-control" placeholder="Address" name="address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Contact Number" name="number" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Beverage Name" name="product_name" required>
                    </div>
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
                    <div class="form-group">
                        <input class="form-control" placeholder="Quantity" name="quantity" required>
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
