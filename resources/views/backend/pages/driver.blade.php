@extends('backend.master.template')
@section('content')
    <main class="content">
        <div class="container-fluid">
            <div class="header">
                <h1 class="header-title">
                    Driver
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Driver List
                                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#defaultModalPrimary" style="float:right">
                                    Add Driver
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
                                                <th>Driver Name</th>
                                                <th>Plate #</th>
                                                <th>Address</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th>File</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($drivers as $key => $driver)
                                            <tr>
                                                <td>{{ ++$key}}</td>
                                                <td>{{ $driver->driver_name}}</td>
                                                <td>{{ $driver->plate_no}}</td>
                                                <td>{{ $driver->address}}</td>
                                                <td>{{ $driver->contact}}</td>
                                                <td>{{ $driver->email}}</td>
                                                {{-- <td>{{ $driver->file}}</td> --}}
                                                <td><a href="{{ asset('images/driver/' . $driver->file)}}" download> <i class="fas fa-download"></i> </a></td>
                                                <td>{{ $driver->status}}</td>
                                                <td class="table-action">
                                                    <a href="#" class="align-middle fas fa-fw fa-pen edit" title="Edit" data-toggle="modal" data-target="#defaultModalPrimary" id={{$driver->id}}></a>
                                                    <a href="{{url('driver/destroy/' . $driver->id)}}" onclick="alert('Are you sure you want to Delete?')"><i class="align-middle fas fa-fw fa-trash"></i></a>
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
                        <h5 class="modal-title">Add Driver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="modal-form" action="{{url('driver/save')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Driver Name</label>
                            <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Driver Name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Plate #</label>
                            <input type="text" class="form-control" id="plate_no" name="plate_no" placeholder="Plate #" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">File</label>
                            <input type="file" class="form-control" id="file" name="file" placeholder="Email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputState">Status</label>
                            <select id="status" name="status" class="form-control" required> 
                                <option value="On-process">On-Process</option>
                                <option value="Registered">Registered</option>
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
                url: '/driver/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('.modal-title').text('Update Driver');
                    $('.submit-button').text('Update');
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                               $('[name ="'+k+'"]').val(v);
                            });
                        });
                    $('#modal-form').attr('action', 'driver/update/' + data.driver.id);
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

            $('.add').click(function(){
                $('.modal-title').text('Add Driver');
                $('.submit-button').text('Add');
                $('#modal-form').attr('action', 'driver/save');
            })
        });
    </script>
@endsection