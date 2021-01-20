<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Team Pura </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <router-link to="/dashboard" :class="[currentPage.includes('dashboard') ? 'active' : '', 'nav-link']">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </router-link>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->


    <!-- Nav Item - Charts -->
    <li class="nav-item">
      
            <router-link to="/customer" :class="[currentPage.includes('customer') ? 'active' : '', 'nav-link']">
                <i class="fas fa-users"></i>
                <span>Customers</span>
            </router-link>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
      
            <router-link to="/product" :class="[currentPage.includes('product') ? 'active' : '', 'nav-link']">
                <i class="fas fa-tag"></i>
                <span>Products</span>
            </router-link>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
      
            <router-link to="/order" :class="[currentPage.includes('order') ? 'active' : '', 'nav-link']">
                <i class="fas fa-cart-arrow-down"></i>
                <span>Orders</span>
            </router-link>
    </li>

</ul>