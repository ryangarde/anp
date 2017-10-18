<div class="card">
    <img class="card-img-top" src="http://i.imgur.com/RRUe0Mo.png" alt="Card image cap">
    <div class="card-body">
        <h6 class="card-title">
            {{ auth()->guard('admin')->user()->name }}
        </h6>
        <p class="card-text">Administrator</p>
    </div>
</div>

@if (request()->is('products'))
<ul class="nav flex-column background py-1 mt-3 sidebar-nav">
    <li class="nav-item">
        <span class="nav-link">Filtering</span>
    </li>
</ul>
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
        <a class="nav-link" href="#products" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
            Products <i class="float-right fa fa-caret-down"></i>
        </a>
    </li>
    <div class="collapse {{ request()->is('products') ? 'show' : '' }} {{ request()->is('products/create') ? 'show' : '' }}" id="products">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('products/create') ? 'active' : '' }}" href="{{ route('products.create') }}">Create New Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ route('products.index') }}">View Products</a>
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
        <a class="nav-link" href="#transactions" data-toggle="collapse" href="#transactions" aria-expanded="false" aria-controls="transactions">
            Transactions
        </a>
    </li>
    <div class="collapse" id="transactions">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="#">Create New Transaction</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">View Transactions</a>
            </li>
        </ul>
    </div>
</ul>

<div class="mt-2 copyright">&copy; 2017 Association of Negros Producers</div>
