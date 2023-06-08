<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">


            <img class="img-profile rounded-circle"
                src="https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg" width="30">
            <span class="mr-2 d-none d-lg-inline small">
                {{ auth()->user()->name }}
                <br>
                <small>{{ auth()->user()->level }}</small>

            </span>
        </div>
    </a>



    <!-- Divider -->

    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Category</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users') }}">
            <i class="fas fa-user"></i>
            <span>User Add</span></a>
    </li>




    <li class="nav-item">
        <a class="nav-link" href="{{ route('products') }}">
            <i class="fas fa-shopping-bag"></i>
            <span>Product</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('customers') }}">
            <i class="fas fa-user"></i>
            <span>Customers</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-shopping-cart"></i>
            <span>Orders</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-user-shield"></i>
            <span>Profile</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-user-cog"></i>
            <span>Roles Manage</span>
        </a>

    </li>

    <li class="nav-item">
        <a class="nav-link" href="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>




    <!-- Divider -->

    <hr class="sidebar-divider d-none d-md-block">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
