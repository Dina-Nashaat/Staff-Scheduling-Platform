<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">Example user</strong>
                            </span> <span class="text-muted text-xs block">Example menu <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Profile</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ isActiveRoute('home') }}">
                <a href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i> <span class="nav-label">Home</span></a>
            </li>
            <li class="{{ isActiveRoute('users') }} {{ isActiveRoute('users.create') }}">
                <a href="{{ url('/users') }}"><i class="fa fa-user" aria-hidden="true"></i> <span class="nav-label">Users Managment</span></a>
            </li>
            <li class="{{ isActiveRoute('availability') }}">
                <a href="{{ url('/availability') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Availabilty</span> </a>
            </li>
			<li class="{{ isActiveRoute('adminviewavailability') }}">
                <a href="{{ url('/adminviewavailability') }}"><i class="fa fa-th-large"></i> <span class="nav-label">View Availabilty</span> </a>
            </li>
        </ul>

    </div>
</nav>
