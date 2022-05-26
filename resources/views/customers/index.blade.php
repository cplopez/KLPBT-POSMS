@extends('layouts.app')
@section('content')


    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-10">
                    <h2>
                        <center>KLP BEVERAGE TRADING</center>
                    </h2>

                </div>

            </div>
    </div>
    {{-- end of HEADER --}}
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h3 class="m-2 font-weight-bold text-primary">Customer Information&nbsp;
                        <a href="#myModal" role="button" class="btn btn-lg btn-primary" data-bs-toggle="modal">
                            ADD</a>
                    </h3>
                </div>
                <div class="container">

                    @if (count($customers) > 0)
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Created_at</th>
                                    <th width="100px" colspan="2"><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($customers) > 0)
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $customer->id }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">

                                                    <div class="">
                                                        <h6 class="mb-0 text-sm">{{ $customer->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $customer->address }}</p>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $customer->contact }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $customer->created_at }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="/customers/{{ $customer->id }}" class="btn btn-primary mx-2"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    View
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="/customers/{{ $customer->id }}/edit" class="btn btn-primary mx-2"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h1>No suppliers information.</h1>
                                @endif
                            </tbody>
                        </table>
                    @else
                        <h1>No Customer's Data Avaiable.</h1>
                    @endif

                    <!-- Button HTML (to Trigger Modal) -->

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
