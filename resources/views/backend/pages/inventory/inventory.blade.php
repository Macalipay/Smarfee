@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Inventory
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Inventory Screen
                                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                    Add Inventory
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
                                                <th>Action</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Critical Level</th>
                                                <th>Quantity Stock</th>
                                                <th>Type</th>
                                                <th>Photo</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inventories as $key => $inventory)
                                                <tr>
                                                    <td>{{ ++$key}}</td>
                                                    <td class="table-action">
                                                        <a href="#" class="align-middle fas fa-fw fa-plus-circle add_stock" title="Add" data-toggle="modal" data-target="#stock_modal" id={{$inventory->id}}></a>
                                                        <a href="#" class="align-middle fas fa-fw fa-pen edit" title="Edit" data-toggle="modal" data-target="#defaultModalPrimary" id={{$inventory->id}}></a>
                                                        <a href="{{url('inventory/destroy/' . $inventory->id)}}" onclick="alert('Are you sure you want to Delete?')"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                    </td>
                                                    <td>{{ $inventory->name }}</td>
                                                    <td>{{ $inventory->price }}</td>
                                                    <td>{{ $inventory->critical_level}}</td>
                                                    <td>{{ $inventory->quantity_stock}}</td>
                                                    <td>{{ $inventory->type}}</td>
                                                    <td width="400px"> <img src="{{ asset('images/product/' . $inventory->photo)}}" alt="Food Picture" srcset="" style="width:10%; height:10%"> </td>
                                                    @if ($inventory->status == 'Good')
                                                        <td class="badge badge-success">{{ $inventory->status }}</td>
                                                    @elseif($inventory->status == 'Critical Level')
                                                        <td class="badge badge-warning">{{ $inventory->status }}</td>
                                                    @else
                                                        <td class="badge badge-danger">{{ $inventory->status }}</td>
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
        {{-- STOCK MODAL --}}
        <div class="modal fade" id="stock_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('inventory/add_stock')}}" method="post">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Quantity</label>
                            <input type="text" class="form-control" id="inventory_id" name="inventory_id" hidden>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
                        </div>
           
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
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
         <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Inventory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form-inventory" action="{{url('inventory/save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Critical Level</label>
                            <input type="number" class="form-control" id="critical_level" name="critical_level" placeholder="Enter Critical Level">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Quantity Stock</label>
                            <input type="number" class="form-control" id="quantity_stock" name="quantity_stock" placeholder="Enter Quantity Stock">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Type</label>
                            <select class="form-control" id="type"  name="type">
                                <option selected disabled>Select Food Type</option>
                                <option value="Food">Food</option>
                                <option value="Drink">Drink</option>
                                <option value="Desert">Desert</option>
                                <option value="Pizza">Pizza</option>
                                <option value="Pasta">Pasta</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Status</label>
                            <select class="form-control" id="status"  name="status">
                                <option selected disabled>Select Status</option>
                                <option value="Good">Good</option>
                                <option value="Critical Level">Critical Level</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" placeholder="Enter Photo">
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
                url: '/inventory/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Inventory');
                    $('.submit-button').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#'+k).val(v);
                            });
                        });
                    $('#modal-form-inventory').attr('action', '/inventory/update/' + data.inventories.id);
                }
            });

        }

        function add_stock(id) {
            $('#inventory_id').val(id);
        }

        $(function() {
            $('#datatables').DataTable({
                responsive: true,
                "pageLength": 100
            });

            $( "table" ).on( "click", ".edit", function() {
                edit(this.id);
            });

            $( "table" ).on( "click", ".add_stock", function() {
                add_stock(this.id);
            });

            $('.add').click(function(){
                $('.modal-title').text('Add Inventory');
                $('.submit-button').text('Add');
                $('#modal-form-inventory').attr('action', '/inventory/save');

            })
        });
    </script>
@endsection