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
            <div class="row">

                <div class="container">

                    <div class="content">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h3 class="m-2 font-weight-bold text-primary">Beverages List&nbsp;
                                    <!-- MODAL for ADDING BEVERAGES-->
                                    <a href="#myModal" role="button" class="btn btn-md btn-primary"
                                        data-bs-toggle="modal"><i class="fas fa-fw fa-plus"></i>Add</a>
                                        <form method="GET" action="/beverages_list">
                                            <select id="category" name="category" class="custom-select">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->cat_name }}" {{ $category->cat_name == $cat_name ? 'selected': '' }}>{{ $category->cat_name }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="userTable" class="table">
                                        <thead>

                                            <th>Beverages Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Price Case</th>
                                            <th colspan="2">Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $beverage_name => $deliveries)
                                                @foreach($deliveries as $caregory_name => $product) 
                                                    <tr class="text-center">
                                                        <td>{{ $beverage_name }}</td>
                                                        <td>{{ $caregory_name }}</td>
                                                        <td>{{ $product['quantity'] }}</td>
                                                        <td>{{ $product['price_case'] }}</td>
                                                        <td class="align-middle">
                                                            <a href="/beverages_list/{{ $product['id'] }}/edit"
                                                                class="btn btn-primary mx-2" data-toggle="tooltip"
                                                                data-original-title="Edit user">
                                                                Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
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

    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body">
                    {!! Form::open(['action' => 'ProductController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        <input class="form-control" placeholder="Beverage Name" type="text" name="beverage_name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Price" type="number" name="price_case" required>
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
    <script>
        $('#category').on('change', function(e){
            $(this).closest('form').submit();
        });
    </script>
@endsection
