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
                <h3> ACTIVE ORDER</h3>
                <h5> Payment Status: {{$sale->payment_status}}</h5>
                <h5> Description/Note: {{$sale->description}}</h5>
                <h5> Total: {{$sale->amount}}</h5>
            @else
                <h3> NO ACTIVE ORDER</h3>
                <h5> Payment Status: </h5>
                <h5> Description/Note: </h5>
                <h5> Total: </h5>
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
                            <a href="#" class="align-middle fa fa-fw fa-retweet " onclick="reorder({{$sale->id}})" title="Re-Order" data-toggle="modal" data-target="#orderModal" id={{$sale->id}}></a>
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
    <div class="clearfix"></div>
  </div>

  @include('backend.partials.order-modal')
@endsection

@section('scripts')
    <script>
         function addToCart(id) {3
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

         $(function() {
          
        });
    </script>
@endsection