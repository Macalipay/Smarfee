@extends('backend.master.template')
@section('links')

    <style>
table.dataTable thead th {
  white-space: nowrap
}
        </style>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    {{Auth::user()->restaurant->store_name}} - Daily Sales
                </h1>
                <p style="color: white">Always record and update the Daily Sales</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Daily Sales
                                {{-- <button type="button" class="btn btn-primary add mr-1" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">Add Order</button>  --}}
                                {{-- <button type="button" class="btn btn-primary add mr-1" data-toggle="modal" data-target="#customerModal" style="float:right">Add Client</button> --}}
                            </h5>
                        </div>
                        @include('backend.partials.flash-message')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Action</th>
                                                <th>Client Name</th>
                                                <th>Description</th>
                                                <th>Driver</th>
                                                <th>Amount</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Payment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($daily_sales as $key => $daily_sale)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td class="table-action">
                                                        <a href="#" class="align-middle fa fa-fw fa-tasks productionStatus" title="Production Status" data-toggle="modal" data-target="#productionStatus" id={{$daily_sale->id}}></a>
                                                        <a href="#" class="align-middle fa fa-fw fa-money-bill paymentModal" title="Payment" data-toggle="modal" data-target="#paymentModal" id={{$daily_sale->id}}></a>
                                                        <a href="#" class="align-middle fa fa-fw fa-shopping-cart" onclick="orderList({{$daily_sale->id}})" title="List of Order" data-toggle="modal" data-target="#orderModal" id={{$daily_sale->id}}></a>
                                                        <a href="{{url('daily_sales/destroy/' . $daily_sale->id)}}" onclick="alert('Are you sure you want to Delete?')"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                    </td>
                                                    <td>{{ $daily_sale->user->firstname . ' ' . $daily_sale->user->lastname}}</td>
                                                    <td>{{ $daily_sale->description}}</td>
                                                    @if ($daily_sale->driver_id != NULL)
                                                        <td>{{ $daily_sale->driver->driver_name}}</td>
                                                    @else
                                                        <td>No Rider Assign</td>
                                                    @endif
                                                    <td>₱ {{ number_format($daily_sale->amount, 2) }}</td>
                                                    <td>₱ {{ number_format($daily_sale->balance, 2) }}</td>
                                                    <td>{{ $daily_sale->status}}</td>
                                                    @if ($daily_sale->payment_status == 'Paid')
                                                        <td class="badge badge-success">{{ $daily_sale->payment_status}}</td>
                                                    @else
                                                        <td class="badge badge-danger">{{ $daily_sale->payment_status}}</td>
                                                    @endif
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
        {{-- MODAL --}}
        <div class="modal fade" id="productionStatus" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Production Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form-production" action="{{url('/daily_sales/productionStatus')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Production Status</label>
                            <div class="col-sm-9 mb-2">
                                <select class="form-control" name="status">
                                    <option value="Check Out">Check Out</option>
                                    <option value="Ready">Ready</option>
                                    <option value="Pick Up By Rider">Pick Up By Rider</option>
                                    <option value="Ongoing Delivery">Ongoing Delivery</option>
                                    <option value="Arrive">Arrive</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>

                            <label class="col-form-label col-sm-3 text-sm-right">Assign Rider</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="driver_id">
                                    @foreach ($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->driver_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button-production">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    

       @include('backend.partials.order-modal')

        {{-- MODAL --}}
        <div class="modal fade" id="paymentStatus" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form-payment" action="{{url('daily_sales/productionStatus')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Payment Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="payment_status">
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid" selected>Unpaid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button-payment">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL --}}
        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form-payment" action="{{url('payment/save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="dailysales_id" id="dailysales_id" hidden>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Payment Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="payment"  name="payment" placeholder="Choose Product">
                                    <option selected disabled>Select a Payment</option>
                                    <option value="GCASH">GCASH</option>
                                    <option value="CASH">CASH</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control payment_date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button-payment">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        function edit(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/daily_sales/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('#modal-form').attr('action', '/daily_sales/update/' + data.products.id);
                    $('.customer_value').val(data.products.customer.name);
                    $('.modal-title').text('Update Order');
                    $('.submit-button').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#'+k).val(v);
                            });
                        });
                }
            });
        }

        function productionStatus(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/daily_sales/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('#modal-form-production').attr('action', '/daily_sales/productionStatus/' + data.products.id);
                    $('.modal-title').text('Production Status');
                    $('.submit-button-production').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#'+k).val(v);
                            });
                        });
                }
            });
        }

        function orderList(id){
            $('#orderTable').dataTable().fnDestroy();

            $('#orderTable').DataTable({
                
                processing: true,
                serverSide: true,
                ajax: {
                url: "order/show/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                },
                columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'inventory.name', name: 'inventory.name' },
                        {data: 'quantity', name: 'quantity' },
                        {data: 'amount', name: 'amount' },
                        {data: 'total', name: 'total' },
                    ],
                order: [[0, 'desc']]
            });
        }

        function paymentStatus(id){
            $('#dailysales_id').val(id);
        }

        $(function() {
            $('#datatables, #orderTable').DataTable({
                "scrollX": true,
                "pageLength": 100
            });

            $('#customer_table').DataTable();


            $( "table" ).on( "click", ".paymentModal", function() {
                paymentStatus(this.id);
            });

            $( "table" ).on( "click", ".edit", function() {
                edit(this.id);
            });

            $( "table" ).on( "click", ".productionStatus", function() {
                productionStatus(this.id);
            });

            $('.add').click(function(){
                $('.modal-title').text('Add Order');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'daily_sales/save');
            })
        });
        function selectCustomer(id, value) {
            $('#customer_id').val(id);
            $('.customer_value').val(value);
        }
    </script>
@endsection

@section('style')
<style>
table#customer_table tr:hover td {
    background: #eee;
    cursor: pointer;
}

.form-control:disabled, .form-control[readonly] {
    background: #fff;
}
</style>    
@endsection