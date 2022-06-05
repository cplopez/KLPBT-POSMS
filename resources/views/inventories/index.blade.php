@extends('layouts.app')
@section('content')

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
                                <form action="/inventories" method="GET">
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
                                    <a type="button" href="{{route('inventory.export', [
                                        'date_end' => $request->date_end ?? '',
                                        'date_start' => $request->date_start ?? '',
                                        'inventory_ids' => json_encode($inventory_ids)
                                        ])}}" 
                                        target="_blank" class="btn btn-md btn-primary">Export</a>
                                </form>
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
                                                                        <td align="right">{{ $inventory->old_quantity}}</td>
                                                                        <td align="right">{{ $inventory->new_quantity}}</td>
                                                                        <td align="right">{{ $inventory->quantity}}</td>
                                                                        <td>{{ $inventory->created_at}}</td>
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
