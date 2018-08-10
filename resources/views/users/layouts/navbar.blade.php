<nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar" {{-- style="background-color: rgba(229, 202, 159, 1) !important;" --}}>
    <div class="container">
        <a class="navbar-brand text-white" href="#">
            <img src="{{ asset('storage/anp-logo-white-2.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav custom-navbar-nav">
                <li>
                    <a class="navbar-brand text-white" href="#">
                        <img src="http://anp.hybrain.co/storage/anp-logo-white-2.png" width="30" height="30" class="d-inline-block align-top" alt="">
                        Association of Negros Producers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Partners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact-us') }}">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about-us') }}">About Us</a>
                </li>
            </ul>

            <div class="mr-auto"></div>

            <ul class="nav navbar-nav custom-navbar-nav">
                @auth
                <li class="nav-item">
                    <a class="nav-link text-info" href="#" onclick="event.preventDefault();">
                        @if (session('message'))
                        <div id="order-successful" class="order-successful">
                            {{ session('message') }}
                        </div>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shopping-cart') }}">{{ $shoppingCart['total_items'] }} <i class="fa fa-shopping-cart"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
