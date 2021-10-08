<nav class="navbar navbar-expand navbar-theme">
    <a class="sidebar-toggle d-flex mr-2">
<i class="hamburger align-self-center"></i>
</a>

    <form class="form-inline d-none d-sm-inline-block">
        <input class="form-control form-control-lite" type="text" placeholder="Search projects...">
    </form>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown ml-lg-2">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown" data-toggle="dropdown">
                    <i class="align-middle fas fa-bell"></i>
                    <span class="indicator"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        4 New Notifications
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col-2">
                                    <i class="ml-1 text-danger fas fa-fw fa-bell"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Update completed</div>
                                    <div class="text-muted small mt-1">Mr. Cruz Set an Appointment.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col-2">
                                    <i class="ml-1 text-warning fas fa-fw fa-envelope-open"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Lorem ipsum</div>
                                    <div class="text-muted small mt-1">Doc. Peter accept schedule on sunday .</div>
                                    <div class="text-muted small mt-1">6h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col-2">
                                    <i class="ml-1 text-primary fas fa-fw fa-building"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Admin Jane login</div>
                                    <div class="text-muted small mt-1">8h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col-2">
                                    <i class="ml-1 text-success fas fa-fw fa-bell-slash"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">New connection</div>
                                    <div class="text-muted small mt-1">Anna accepted your request.</div>
                                    <div class="text-muted small mt-1">12h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown ml-lg-2" id="userDropdown_list">
				<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-toggle="dropdown">
					<i class="align-middle fas fa-cog"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePicture"><i class="align-middle mr-1 fas fa-fw fa-user"></i> Change Profile Picture</a>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword"><i class="align-middle mr-1 fas fa-fw fa-key"></i> Change Password</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<i class="align-middle mr-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out</a>
					 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						 @csrf
					 </form>
				</div>
			</li>
        </ul>
    </div>

</nav>