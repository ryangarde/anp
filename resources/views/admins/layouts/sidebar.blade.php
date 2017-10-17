<div class="card">
    <img class="card-img-top" src="http://i.imgur.com/RRUe0Mo.png" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{ auth()->guard('admin')->user()->name }}</h5>
        <p class="card-text">Administrator</p>
    </div>
</div>

<ul class="nav flex-column background py-1 mt-3">
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dasboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#producers" data-toggle="collapse" href="#producers" aria-expanded="false" aria-controls="producers">
            Producers
        </a>
    </li>
    <div class="collapse" id="producers">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('producers.create') }}">Create New Producer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('producers.index') }}">View Producers</a>
            </li>
        </ul>
    </div>
    <li class="nav-item">
        <a class="nav-link" href="#products" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
            Products
        </a>
    </li>
    <div class="collapse" id="products">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link" href="#">Create New Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">View Products</a>
            </li>
        </ul>
    </div>
    <li class="nav-item">
        <a class="nav-link" href="#categories" data-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories">
            Categories
        </a>
    </li>
    <div class="collapse" id="categories">
        <ul class="nav flex-column nav-sub-menu">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('categories.create') }}">Create New Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">View Categories</a>
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
