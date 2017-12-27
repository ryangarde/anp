<div class="card">
    <img class="card-img-top img-fluid" src="https://wallpaperscraft.com/image/space_sky_stars_79233_1366x768.jpg" alt="Card image cap">
    <div class="card-body">
        <h6 class="card-title">
            {{ auth()->user()->name }}
        </h6>
    </div>
</div>

@if (request()->is('products'))
@include('admins.products.filter')
@endif

<ul class="nav flex-column background py-1 mt-3 sidebar-nav">
    <li class="nav-item">
        <span class="nav-link" href="{{ route('dashboard') }}">Dashboards</span>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Account Information</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('shopping-cart') ? 'active' : '' }}" href="{{ route('shopping-cart') }}">Shopping Cart</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  {{ request()->is('orders') ? 'active' : '' }}" href="#">Orders</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Settings</a>
    </li>
</ul>

<div class="mt-2 copyright">&copy; 2017 Association of Negros Producers</div>

<br>
