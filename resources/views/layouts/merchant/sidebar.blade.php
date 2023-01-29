<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route("merchant.home")  }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Merchant</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if (Route::is('merchant.home')) active @endif">
        <a class="nav-link" href="{{ route("merchant.home")  }}" >
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>User Demographics </span></a>
    </li>
    <li class="nav-item @if (Route::is('merchant.category*')) active @endif">
        <a class="nav-link" href="{{ route('merchant.category.index') }}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Category</span></a>
    </li>
    <li class="nav-item @if (Route::is('merchant.sub-category*')) active @endif">
        <a class="nav-link" href="{{ route('merchant.sub-category.index') }}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Sub Category</span></a>
    </li>
    <li class="nav-item @if (Route::is('merchant.product*')) active @endif">
        <a class="nav-link" href="{{ route('merchant.product.index') }}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Product</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('merchant.approve.index') }}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Approve Order</span>
        </a>
    </li>  
    <li class="nav-item @if (Route::is('merchant.setting*')) active @endif">
        <a class="nav-link" href="{{ route('merchant.setting.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Merchant Settings</span></a>
    </li>
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Log Out</span>
        </a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->