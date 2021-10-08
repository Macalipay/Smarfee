@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Payment
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Payment Maintenance Screen
                                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                    Add Payment
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
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Payment Type</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $key => $payment)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td>{{ $payment->sales_order->name }}</td>
                                                    <td>{{ $payment->amount}}</td>
                                                    <td>{{ $payment->payment_type}}</td>
                                                    <td>{{ date('M-d-Y', strtotime($payment->date))}}</td>
                                                    <td class="table-action">
                                                        <a href="#" class="align-middle fas fa-fw fa-pen edit" title="Edit" data-toggle="modal" data-target="#defaultModalPrimary" id={{$payment->id}}></a>
                                                        <a href="{{url('payment/destroy/' . $payment->id)}}" onclick="alert('Are you sure you want to Delete?')"><i class="align-middle fas fa-fw fa-trash"></i></a>
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
            </div>
        </div>
        {{-- MODAL --}}
        <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('payment/save')}}" method="post">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Amount</label>
                            <input type="text" class="form-control" id="dailysales_id" name="dailysales_id" hidden>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Payment Type</label>
                            <select class="form-control" id="payment_type"  name="payment_type" placeholder="Choose Payment">
                                <option selected disabled>Select a Payment</option>
                                <option value="CASH">CASH</option>
                                <option value="GCASH">GCASH</option>
                                <option value="BDO">BDO</option>
                                <option value="BPI">BPI</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Date</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Payment">
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
                url: '/payment/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Payment');
                    $('.submit-button').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#'+k).val(v);
                            });
                        });
                    $('#modal-form').attr('action', 'payment/update/' + data.payments.id);
                }
            });

        }

        $(function() {
            $('#datatables').DataTable({
                responsive: true
            });

            $( "table" ).on( "click", ".edit", function() {
                edit(this.id);
            });

            $('.add').click(function(){
                $('.modal-title').text('Add Payment');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'payment/save');

            })
        });
    </script>
@endsection