<nav id="global-nav" class="navbar navbar-expand-lg navbar-light">
    {{-- <a class="navbar-brand" href="">
        <img class="img-fluid logo-hybrain" src="{{ asset('images/hybrain-logo.png') }}" alt="HYBrain Logo">
    </a> --}}

    <a class="navbar-brand ml-md-5 ml-0" href="/">
        <img id="anp-logo" src="{{ asset('images/anp-logo.png') }}" class="d-inline-block img-fluid" alt="" style="max-height: 100px">
        {{-- <span class="small" style="color: white;">HYBrain</span> --}}
    </a>

    <button class="navbar-toggler ml-0" type="button" id="cd-cart-trigger" style="position: absolute; right: 3%;">
        <a href="#0"><span class="navbar-toggler-icon"></span></a>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto"></div>

        <ul class="navbar-nav small">
            <li class="nav-item">
                <a class="nav-link mx-2" href="/"><strong>HOME</strong></a>
            </li>
            <li class="nav-item dropdown show-on-hover">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <strong>WHO WE ARE</strong>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown show-on-hover">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <strong>MEMBERSHIP</strong>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown show-on-hover">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <strong>PROGRAMS AND SERVICES</strong>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="/"><strong>PARTNERS</strong></a>
            </li>
            <li class="nav-item dropdown show-on-hover">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <strong>NEWS</strong>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="{{ route('shop-v2') }}"><strong>E COMMERCE</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="/"><strong>CONTACT US</strong></a>
            </li>
        </ul>
    </div>
</nav>

<div id="cd-shadow-layer"></div>
<div id="cd-cart" class="text-right">
    <ul class="navbar-nav small">
        <li class="nav-item">
            <a class="nav-link mx-2" href="/"><strong>HOME</strong></a>
        </li>
        <li class="nav-item dropdown show-on-hover">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <strong>WHO WE ARE</strong>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown show-on-hover">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <strong>MEMBERSHIP</strong>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown show-on-hover">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <strong>PROGRAMS AND SERVICES</strong>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link mx-2" href="/"><strong>PARTNERS</strong></a>
        </li>
        <li class="nav-item dropdown show-on-hover">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <strong>NEWS</strong>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link mx-2" href="{{ route('shop-v2') }}"><strong>E COMMERCE</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link mx-2" href="/"><strong>CONTACT US</strong></a>
        </li>
    </ul>
</div>