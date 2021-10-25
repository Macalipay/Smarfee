<div class="clearfix"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-white">
    <div class="container"> <a class="navbar-brand" href="index.html"> <img src="assets/images/logo.png" alt="" title="" class="img-fluid"> </a>
      <button  id="sidebarCollapse" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> <span class="navbar-toggler-icon"></span> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="nav-item"> <a class="nav-link" href="{{url('/')}}">Home</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('shop')}}">Shop</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('shop/history')}}">History</a></li>
        </ul>
        <div class="rate-price nav-1">
          <ul>
                @if (Route::has('login'))
                    @auth
                    <li class="dropdown"> <a class="dropdown-toggle" href="" data-toggle="dropdown"> {{Auth::user()->firstname . ' ' . Auth::user()->lastname}} <i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                      <div class="dropdown-menu dropdown-menu-right animate slideIn"> 
                    <div class="top-right links">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="align-middle mr-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out</a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                    @else
                    <li class="dropdown"> <a class="dropdown-toggle" href="" data-toggle="dropdown"> <i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                      <div class="dropdown-menu dropdown-menu-right animate slideIn"> 
                        <a class="dropdown-item" href="{{ url('shop/login') }}">Login</a>
                        @if (Route::has('register'))
                            <a class="dropdown-item" href="{{ url('shop/register') }}">Register</a> 
                        @endif
                    @endauth
                </div>
            @endif
            </li>
            <li class="dropdown" onclick="shoppingBag();"> <a class="dropdown-toggle link" href="" data-toggle="dropdown"><i class="fa fa-shopping-bag" aria-hidden="true"></i><span class="circle-2">1</span></a>
              <div class="dropdown-menu dropdown-menu2 dropdown-menu-right animate slideIn">
                <div class="container">
                  <div class="row">
                    
                    <div class="col-md-3"><img src="assets/images/auto-parts/img-4.jpg" alt="" title="" class="img-fluid"></div>
                    <div class="col-md-12" id="order_list">
                      
                    </div>
                    <div class="col-md-12">
                      <hr>
                    </div>
                    <div class="col-md-12">
                      <hr>
                    </div>
                    <div class="col-md-3">
                      <p class="font-15"><strong>Total</strong></p>
                    </div>
                    <div class="col-md-9 text-right"> <span class="font-15"><strong id="total_price"></strong></span> </div>
                    <div class="col-md-12">
                      <hr>
                    </div>
                    <div class="col-md-12 text-center">
                      <input type="button" value="Check out" onclick="checkOut()" class="btn check-out w-100">
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </nav>

  <div class="container search-div">
    <div class="row">
      <div class="col-lg-4 col-md-4">
        <div class="all-cate custom-select2">
          <select>
            <option>Coffee Brew</option>
            <option>Iced Coffee</option>
            <option>Milktea</option>
            <option>Dessert Frappe</option>
            <option>Milkshakes</option>
          </select>
        </div>
      </div>
    </div>
  </div>