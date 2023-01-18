<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-white sidebar sidebar-light accordion position-fixed " id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a href="{{ route('user.home') }}" class="sidebar-brand d-flex align-items-center justify-content-center my-3">
        <div class="sidebar-brand-icon">
            <i class="fas fa-shopping-bag text-danger"></i>
        </div>
        <div class="sidebar-brand-text mx-3 lead"><span class="font-weight-normal">Shopapp</span> </div>
    </a>
    <hr class="sidebar-divider">
    <div class="nav-item sidebar-brand-text mx-3 lead font-weight-normal px-2">
        <i class="fas fa-fw fa-list"></i>
        <span >Categories</span>
    </div>
    <hr class="sidebar-divider">
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    @foreach ($categories as $category)
    <li class="nav-item px-2">
        <a class="nav-link" href="{{ route('customer.show.category', ['id'=>$category->id]) }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span class="name">{{ $category->name }}</span>
        </a>
    </li>
    @endforeach

    
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->