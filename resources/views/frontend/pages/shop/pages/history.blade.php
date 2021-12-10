@extends('frontend.pages.shop.master.template')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="bread-boder">
      <div class="row">
        <div class="col-lg-8 col-md-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="breadcrumb-item">Shop</li>
          </ol>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
    </nav>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if ($sale != null)

            <button type="button" class="btn btn-danger col-lg-2 col-md-2 cancel_order " data-toggle="modal" id="{{$sale->id}}" data-target="#cancelOrder" style="float:right">
                Cancel Order
            </button>
                <h3> ACTIVE ORDER</h3>
                <h5> Payment Status: {{$sale->payment_status}}</h5>
                <h5> Description/Note: {{$sale->description}}</h5>
                <h5> Total: {{$sale->amount}}</h5>
                <h5> Status: <span style="color:blue">{{$sale->status}}</span> </h5>
            @else
                <h3> NO ACTIVE ORDER</h3>
                <h5> Payment Status: </h5>
                <h5> Description/Note: </h5>
                <h5> Total: </h5>
                <h5> Status: </h5>
            @endif
            
            <table id="datatables" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                   @forelse ($orders as $key => $order)
                        <tr>
                            <td>{{ ++$key}}</td>
                            <td>{{ $order->inventory->name}}</td>
                            <td>{{ $order->quantity}}</td>
                            <td>{{ $order->amount}}</td>
                            <td>{{ $order->total}}</td>
                        </tr>
                   @empty
                       <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                       </tr>
                   @endforelse
                </tbody>
            </table>
    
            <br>
            <br>
            <br>
            <h3> PREVIOUS ORDER </h3>
            <table id="datatables" class="table table-striped" style="width:100%">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Action</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($sales as $key => $sale)
                      <tr>
                          <td>{{ ++$key}}</td>
                          <td>
                            <a href="#" class="align-middle fa fa-fw fa-shopping-cart" onclick="orderList({{$sale->id}})" title="List of Order" data-toggle="modal" data-target="#orderModal" id={{$sale->id}}></a>
                          </td>
                          <td>{{ $sale->user->firstname . ' ' . $sale->user->lastname}}</td>
                          <td>{{ $sale->description}}</td>
                          <td>{{ $sale->amount}}</td>
                          <td>{{ $sale->status}}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
    </div>
     {{-- MODAL --}}
     <div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form id="modal-form-cancel" action="{{url('daily_sales/cancel')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Description</label>
                            <textarea  class="form-control" name="description" id="description" cols="5" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default col-lg-2 col-md-2" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-button-production col-lg-2 col-md-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
  </div>

  @include('backend.partials.order-modal')
@endsection

@section('scripts')
    <script>
         function addToCart(id) {
           $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/shop/add_to_cart',
                method: 'get',
                data: {
                  quantity: $('#'+id+' .quantity').val(),
                  inventory_id: id,
                },
                success: function(data) {
                   
                }
            });
         }

         function cancel(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/daily_sales/edit/' + id,
                method: 'get',
                data: {

                },
                success: function(data) {
                    $('#modal-form-cancel').attr('action', '/daily_sales/cancel/' + data.products.id);
                        $.each(data, function() {
                            $.each(this, function(k, v) {
                                $('#'+k).val(v);
                            });
                        });
                }
            });
        }

         $(function() {
            $('.cancel_order').click(function(){
                cancel(this.id);
            })
        });
    </script>
@endsection