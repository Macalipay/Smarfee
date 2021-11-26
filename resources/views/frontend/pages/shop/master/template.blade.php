<!DOCTYPE html>
<html lang="zxx">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
<meta name="description" content="">
<meta name="author" content="">
<title>Smarfee</title>
<link rel="stylesheet" href="{{ asset('opimac/html/assets/css/main.css')}}">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

</head>
<body>
@include('frontend.pages.shop.partials.sidebar')
@include('frontend.pages.shop.partials.header')
@yield('content')

<div id="newsletter">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h4>Join Our Newsletter Now</h4>
        <p class="m-0">Get E-mail updates about our latest shop and special offers.</p>
      </div>
      <div class="col-md-5">
        <form action="/" method="post" id="subsForm" onSubmit="return ajaxmailsubscribe();">
          <div class="input-group">
            <input type="email" name="subsemail" id="subsemail" class="form-control newsletter" placeholder="Enter your mail">
            <span class="input-group-btn">
            <button class="btn btn-theme" type="button" onClick="return ajaxmailsubscribe();">Subscribe</button>
            </span> </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Footer -->
@include('frontend.pages.shop.partials.footer')

  
<!-- Footer -->

<script src="{{ asset('opimac/html/assets/js/ajax.js')}}"></script>
<script src="{{ asset('opimac/html/assets/js/formValidation.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/wow/wow.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/wow/page.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/jquery/mega-menu.js')}}"></script>
<link rel="stylesheet" href="{{ asset('opimac/html/assets/vendor/price_range/jquery-ui.css')}}" type="text/css" media="all" />
<script src="{{ asset('opimac/html/assets/vendor/price_range/jquery-ui.min.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/price_range/price_range_script.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/price_range/price_range_style.css')}}"/>
<script src="{{ asset('opimac/html/assets/vendor/stepper/jquery.min.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/stepper/jquery-ui.min.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/jquery/stepper.widget.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/jquery/custom-select.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/jquery/grid-list.js')}}"></script>
<link rel="stylesheet" href="{{ asset('opimac/html/assets/css/product-hover.css')}}">
<link rel="stylesheet" href="{{ asset('opimac/html/assets/vendor/fancy-box/fancybox.min.css')}}" />
<script src="{{ asset('opimac/html/assets/vendor/fancy-box/jquery.fancybox.min.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/jquery/scrolltopcontrol.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/side-menu/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{ asset('opimac/html/assets/vendor/side-menu/side-menu.js')}}"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
   function shoppingBag(){
      $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/shop/shopping_bag',
            method: 'get',
            success: function(data) {
              var order = data.orders;
               $('#order_list').empty();
               $('#total_price').empty();
               $('#total_price').append(data.sale.amount);
               for (let index = 0; index < order.length; index++) {
                  $('#order_list').append('<div style="display: flex; text-indent: 20px;"><p>' + order[index].inventory.name + 
                                            '<span class="price">'+ order[index].total +'</span>'+
                                            '<span class="price">'+ order[index].quantity +'</span>'+
                                            '<span class="price">'+ order[index].amount +'</span></div></p> ');
               }
            }
        });
   }

   function checkOut(){
    var message = prompt("Enter Note or Description", "No Message");
      $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/shop/check_out',
            method: 'get',
            data: {
              description: message
            },
            success: function(data) {
              
            }
        });
   }

   function orderList(id){
            $('#orderTable').dataTable().fnDestroy();

            $('#orderTable').DataTable({
                
                processing: true,
                serverSide: true,
                ajax: {
                url: "/order/show/" + id,
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

      $(function() {
            
            $('#orderTable').DataTable({
                "scrollX": true,
                "pageLength": 100
            });
        });
</script>
@yield('scripts')
<p data-toggle="modal" class="no-margin" data-target="#myModal" id="model2"></p>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content text-center">
      <div class="modal-body modal-body2">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p><img src="assets/images/success.svg" alt="" title="" width="50"></p>
        <h3 class="modal-title">Thank you</h3>
        <h4 class="thanks mt-2">Your submission is recevied and we will contact you soon.</h4>
        <a href="#" target="_blank" class="btn add-to-cart2 d-inline-block font-15 rounded">BUY THIS TEMPLATE NOW</a> <a href="index.html" class="back-to-home d-block small mt-2"><i class="fa fa-long-arrow-left"></i> BACK TO HOME</a> </div>
    </div>
  </div>
</div>
</body>
</html>
