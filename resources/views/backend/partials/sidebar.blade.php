<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="#">
  <svg>
    <use xlink:href="#ion-ios-pulse-strong"></use>
  </svg>
  Smarfee
</a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            <img src="{{ asset('backend/docs/img/avatars/avatar.jpg')}}" class="img-fluid rounded-circle mb-2" alt="Linda Miller" />
            <div class="font-weight-bold">{{Auth::user()->name}}</div>
            <small>{{Auth::user()->email}}</small>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>
            @role('Owner')
            <li class="sidebar-item">
                <a href="#dashboards" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle mr-2 fas fa-fw fa-chart-pie" style="color: #153d77"></i> <span class="align-middle">Dashboard</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('dashboard')}}">Daily</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('dashboard/monthly') }}">Monthly</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('dashboard/masterfile') }}">Master File</a></li>
                </ul>
            </li>
            @endrole

            @role('Admin')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{url('restaurant')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-store-alt" style="color: #153d77"></i> <span class="align-middle">Restaurant</span>
                </a>
            </li>
            @endrole

            <li class="sidebar-header">
                Transaction
            </li>
           @role('Owner')
            <li class="sidebar-item">
                <a href="#salesorder" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle mr-2 fas fa-fw fa-cart-plus" style="color: #153d77"></i> <span class="align-middle">Sales Order</span>
                </a>
                <ul id="salesorder" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('daily_sales')}}">Daily Sales</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('daily_sales/all')}}">All Sales</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('payment')}}">Payment</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#inventoryside" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle mr-2 fas fa-fw fa-dolly-flatbed" style="color: #153d77"></i> <span class="align-middle">Inventory</span>
                </a>
                <ul id="inventoryside" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('inventory')}}">Inventory</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ url('inventory/view_add_stock')}}">Inventory Transaction</a></li>
                </ul>
            </li>
            
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('driver')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-motorcycle" style="color: #153d77"></i> <span class="align-middle">Drivers</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-star-half-alt" style="color: #153d77"></i> <span class="align-middle">Reviews</span>
                </a>
            </li>
            @endrole

            @role('Admin')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('user')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-users" style="color: #153d77"></i> <span class="align-middle">Users</span>
                </a>
            </li>

            <li class="sidebar-header">
                Maintenance
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('city')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-city" style="color: #153d77"></i> <span class="align-middle">City</span>
                </a>
            </li>
            @endrole

            @role('Owner')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('rule')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-times" style="color: #153d77"></i> <span class="align-middle">Rules and Restriction</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('term')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-file-word" style="color: #153d77"></i> <span class="align-middle">Terms and Condition</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
</nav>