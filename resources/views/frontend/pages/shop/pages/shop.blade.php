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
        <div class="row">
          <div class="col-12">
         
            <div class="right-heading">
              <div class="row">
               
                <div class="col-md-4 col-4">
                
                  <h3>Shop - {{$restaurant->store_name}} </h3>
                </div>
                <div class="col-md-8 col-8">
                  <div class="product-filter">
                    <div class="view-method"> <a href="" id="grid"><i class="fa fa-th-large"></i></a> <a href="" id="list"><i class="fa fa-list"></i></a> </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            
        
            <div id="products" class="row view-group">
              @foreach ($products as $product)
              <div class="item col-lg-4 col-md-4 mb-4 mb-4" id="{{$product->id}}">
                <div class="thumbnail card product">
                  <div class="img-event"> <a class="group list-group-image img-fluid" href="#"><img src="{{('/images/product/' . $product->photo)}}" alt="" class="img-fluid" style="width: 300px; height: 300px" ></a> </div>
                  <div class="caption card-body">
                    <h3 class="product-type">{{ $product->type }}</h3>
                    <h4 class="product-name">{{ $product->name }}</h4>
                    <h4 class="product-name">{{ $product->description }}</h4>
                    <div class="row m-0 list-n">
                      <div class="col-12 p-0">
                        <h5 class="product-price">₱ {{ $product->price }}</h5>
                      </div>
                      <div class="col-12 p-0">
                        <div class="product-price">
                          <form class="form-inline">
                            <div class="stepper-widget">
                              <button type="button" class="js-qty-down">-</button>
                              <input type="text" class="js-qty-input quantity" value="1"/>
                              <button type="button" class="js-qty-up">+</button>
                              <button type="button" onclick="addToCart({{$product->id . ',' . $product->restaurant_id}})" class="add2"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="product-select">
                    </div>
                  </div>
                </div>
              </div>
           
              @endforeach
              <div class="clearfix"></div>
              <!-- Pagination -->
            </div>
            <div>
              <iframe style="border:0; width: 100%; height: 270px;" src="{{$restaurant->map}}" frameborder="0" allowfullscreen></iframe>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
{{-- modal --}}
  <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms and Condition/Rule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                  <h5>Terms and Condition</h5>
                  @foreach ($terms as $term)
                      <li>{{$term->term . ' - ' . $term->description}} </li>
                  @endforeach
                <br>
                  <h5>Rules</h5>
                  @foreach ($rules as $rule)
                      <li>{{$rule->rule . ' - ' . $rule->description}} </li>
                  @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
         function addToCart(id, restaurant_id) {

          if (confirm('Are you sure you want to add this item?')) {
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: '/shop/add_to_cart',
                  method: 'get',
                  data: {
                    quantity: $('#'+id+' .quantity').val(),
                    inventory_id: id,
                    restaurant_id: restaurant_id,
                  },
                  success: function(data) {
                    
                  }
              });
          }
         }

         $(function() {
          $('#defaultModalPrimary').modal('toggle');
        });
    </script>
@endsection