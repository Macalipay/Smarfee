@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Order List
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Order List
                                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                    Add Order
                                </button>
                            </h5>
                        </div>
                        @include('backend.partials.flash-message')
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Order</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Total Amount</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales_orders as $key => $sales_order)
                                                <tr>
                                                    <td class="table-action">
                                                        <a href="#" class="align-middle fa fa-fw fa-money-bill paymentModal" title="Payment" data-toggle="modal" data-target="#paymentModal" id={{$sales_order->id}}></a>
                                                        <a href="#" class="align-middle fas fa-fw fa-pen edit" title="Edit" data-toggle="modal" data-target="#defaultModalPrimary" id={{$sales_order->id}}></a>
                                                        <a href="{{url('sales_order/destroy/' . $sales_order->id)}}" onclick="alert('Are you sure you want to Delete?')"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                    </td>
                                                    <td>{{ ++$key}}</td>
                                                    <td>{{ $sales_order->name}}</td>
                                                    <td>{{ $sales_order->order}}</td>
                                                    <td>{{ $sales_order->description}}</td>
                                                    <td>{{ $sales_order->quantity}}</td>
                                                    <td>{{ $sales_order->total_amount}}</td>
                                                    <td>{{ $sales_order->balance}}</td>
                                                    <td>{{ $sales_order->status}}</td>
                                                    
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
        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('sales_order/save')}}" method="post">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Customer Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Order</label>
                            <input type="text" class="form-control" id="order" name="order" placeholder="Order" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Total Amount</label>
                            <input type="number" class="form-control" id="total_amount" name="total_amount" placeholder="Total Amount" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputState">Status</label>
                            <select id="status" name="status" class="form-control" required> 
                                <option value="On-going">On-going</option>
                                <option value="On-hold">On-hold</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit-button">Add</button>
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
                                <input type="text" class="form-control" name="sales_order_id" id="sales_order_id" hidden>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Payment Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="payment_type"  name="payment_type" placeholder="Choose Product">
                                    <option selected disabled>Select a Payment</option>
                                    <option value="CASH">CASH</option>
                                    <option value="GCASH">GCASH</option>
                                    <option value="BDO">BDO</option>
                                    <option value="BPI">BPI</option>
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
                url: '/sales_order/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Patient Record');
                    $('.submit-button').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                               $('[name ="'+k+'"]').val(v);
                            });
                        });
                    $('#modal-form').attr('action', 'sales_order/update/' + data.sales_order.id);
                }
            });

        }

        $(function() {
            $('#datatables').DataTable({
                responsive: true,
                "pageLength": 100
            });

            $( "table" ).on( "click", ".edit", function() {
                edit(this.id);
            });

            $( "table" ).on( "click", ".paymentModal", function() {
                $('#sales_order_id').val(this.id);
            });

            $('.add').click(function(){
                $('.modal-title').text('Add Patient Record');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'sales_order/save');
            })
        });
    </script>
@endsection