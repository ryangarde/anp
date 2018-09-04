<div class="card">
    <img class="card-img-top img-fluid" src="https://wallpaperscraft.com/image/space_sky_stars_79233_1366x768.jpg" alt="Card image cap">
    <div class="card-body">
        <h6 class="card-title">
            {{ auth()->guard('admin')->user()->name }}
        </h6>
        <p class="card-text">Administrator</p>
    </div>
</div>

@if (request()->is('products'))
@include('admins.products.filter')
@endif

<ul class="nav flex-column background py-1 mt-3 sidebar-nav">
    <li class="nav-item">
        <span class="nav-link" href="{{ route('admin.dashboard') }}">Dashboards</span>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Overview</a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="#producers" data-toggle="collapse" href="#producers" aria-expanded="false" aria-controls="producers">
            Producers <i class="float-right fa fa-caret-down"></i>
        </a>
    </li>
    <div class="collapse {{ request()->is('producers') ? 'show' : '' }} {{ request()->is('producers/create') ? 'show' : '' }}" id="producers">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('producers/create') ? 'active' : '' }}" href="{{ route('producers.create') }}">Create New Producer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('producers') ? 'active' : '' }}" href="{{ route('producers.index') }}">View Producers</a>
            </li>
        </ul>
    </div>


     <li class="nav-item">
        <a class="nav-link" href="#categories" data-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories">
            Categories <i class="float-right fa fa-caret-down"></i>
        </a>
    </li>
    <div class="collapse {{ request()->is('categories') ? 'show' : '' }} {{ request()->is('categories/create') ? 'show' : '' }}" id="categories">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('categories/create') ? 'active' : '' }}" href="{{ route('categories.create') }}">Create New Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('categories') ? 'active' : '' }}" href="{{ route('categories.index') }}">View Categories</a>
            </li>
        </ul>
    </div>


    <li class="nav-item">
        <a class="nav-link" href="#products" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
            Products <i class="float-right fa fa-caret-down"></i>
        </a>
    </li>
    <div class="collapse {{ request()->is('products') ? 'show' : '' }} {{ request()->is('products/create') ? 'show' : '' }} {{ request()->is('retail/create') ? 'show' : '' }} {{ request()->is('retail') ? 'show' : '' }}" id="products">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('products/create') ? 'active' : '' }}" href="{{ route('products.create') }}">Create New Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ route('products.index') }}">View Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('retail/create') ? 'active' : '' }}" href="{{ route('admins.retailSizes.create') }}">Create New Retail Size</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('retail') ? 'active' : '' }}" href="{{ route('admins.retailSizes.index') }}">View Retail Size</a>
            </li>
        </ul>
    </div>


    <li class="nav-item">
        <a class="nav-link" href="#orders" data-toggle="collapse" aria-expanded="false" aria-controls="orders">
            Orders <i class="float-right fa fa-caret-down"></i>
        </a>
    </li>
    <div class="collapse {{ request()->is('orders/pending') ? 'show' : '' }} {{ request()->is('orders/confirmed') ? 'show' : '' }}" id="orders">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('orders/pending') ? 'active' : '' }}" href="{{ route('admins.orders.pending') }}">Pending Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('orders/confirmed') ? 'active' : '' }}" href="{{ route('admins.orders.confirmed') }}">Confirmed Orders</a>
            </li>
        </ul>
    </div>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('admins.messages.index') }}">Messages</a>
    </li>
</ul>


<ul class="nav flex-column background py-1 mt-3 sidebar-nav">
    <li class="nav-item">
        <span class="nav-link" href="{{ route('admin.dashboard') }}">Access Control List</span>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admins.users.index') }}">List of Customers</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#admins" data-toggle="collapse" href="#admins" aria-expanded="false" aria-controls="admins">
            Admins <i class="float-right fa fa-caret-down"></i>
        </a>
    </li>
    <div class="collapse {{ request()->is('admins') ? 'show' : '' }} {{ request()->is('admins/create') ? 'show' : '' }}" id="admins">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admins/create') ? 'active' : '' }}" href="{{ route('admins.create') }}">Create New Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admins') ? 'active' : '' }}" href="{{ route('admins.index') }}">View Admins</a>
            </li>
        </ul>
    </div>


    <li class="nav-item">
        <a class="nav-link" href="#roles" data-toggle="collapse" href="#roles" aria-expanded="false" aria-controls="roles">
            Roles <i class="float-right fa fa-caret-down"></i>
        </a>
    </li>
    <div class="collapse {{ request()->is('roles') ? 'show' : '' }} {{ request()->is('roles/create') ? 'show' : '' }}" id="roles">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('roles/create') ? 'active' : '' }}" href="{{ route('roles.create') }}">Create New Role</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('roles') ? 'active' : '' }}" href="{{ route('roles.index') }}">View Roles</a>
            </li>
        </ul>
    </div>


    <li class="nav-item">
        <a class="nav-link" href="#permissions" data-toggle="collapse" href="#permissions" aria-expanded="false" aria-controls="permissions">
            Permissions <i class="float-right fa fa-caret-down"></i>
        </a>
    </li>
    <div class="collapse {{ request()->is('permissions') ? 'show' : '' }} {{ request()->is('permissions/create') ? 'show' : '' }}" id="permissions">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('permissions/create') ? 'active' : '' }}" href="{{ route('permissions.create') }}">Create New Permission</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('permissions') ? 'active' : '' }}" href="{{ route('permissions.index') }}">View Permissions</a>
            </li>
        </ul>
    </div>


    <li class="nav-item">
        <a class="nav-link" href="#">Settings</a>
    </li>
</ul>

<div class="mt-2 copyright">&copy; 2017 Association of Negros Producers</div>

<br>
