@extends('users.layouts.app')

@section('title', 'Official Website of the Association of Negros Producers')

@section('content')
    <div class="container-fluid" style="background: url('/images/home-banner.jpg') no-repeat top/cover; height: 600px"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <h1 class="title-color">WELCOME TO THE</h1>
                <h1 class="title-color">ASSOCIATION OF NEGROS PRODUCERS</h1>

                <div class="d-flex-nowrap mt-5">
                    <div class="d-inline-block">
                        <div class="title-color">OUR COMPANY</div>
                        <img src="{{ asset('images/anp-logo.png') }}" alt="" height="150">
                        <h4 class="title-color">The Association of Negros Producers</h4>
                        <p class="title-color">A Success Story on Self-Reliance</p>
                        <p class="title-color">ANP is born of an ironically sweet crisis, a historical landmark of great distress. The fateful fall of the sugar industry in the 1980's where the world sugar prices plummented and government took control of sugar trading crippled the economy of Negros.</p>

                        <div class="title-color mt-4">
                            <h4>ANP Awards:</h4>
                            <div>&diam; DOST Dungog S&T - 2016</div>
                            <div>&diam; Outstanding Bacolod Business Support Organization - 2007</div>
                            <div>&diam; DTI and PRA Outstanding Filipino Retailers - 2008</div>
                            <div>&diam; Outstanding non-government organization</div>
                            <div>&diam; Outstanding Kabisig-Type Project (Micro Lending Project)</div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-around text-center title-color">
                    <div class="d-inline-block">
                        <i class="fa fa-file-text-o fa-3x"></i>
                        <h6 class="my-4"><strong>PROGRAMS</strong></h6>
                        <div><a href="">The Negros Showroom</a></div>
                        <div><a href="">Negros Tradefair</a></div>
                        <div><a href="">OURFood</a></div>
                        <div><a href="">Bulawan Awards</a></div>
                        <div><a href="">Local Fairs or Bazaars</a></div>
                        <div><a href="">Trainings</a></div>
                        <div><a href="">Negros Seal of Excellence</a></div>
                        <div><a href="">WeTrace</a></div>
                    </div>

                    <div class="d-inline-block">
                        <i class="fa fa-pie-chart fa-3x"></i>
                        <h6 class="my-4"><strong>SECTORS</strong></h6>
                        <div><a href="">A-2 Cooperative / Association</a></div>
                        <div><a href="">Agri Farm-Based Producers</a></div>
                        <div><a href="">Fashion and Garments</a></div>
                        <div><a href="">Food</a></div>
                        <div><a href="">Furniture and Furnishing</a></div>
                        <div><a href="">Gift Decors and Housewares</a></div>
                        <div><a href="">Natural and Organic</a></div>
                        <div><a href="">Tourism</a></div>
                    </div>
                </div>

                <h1 class="mt-5 mb-3 title-color">NEGROS TRADE FAIR</h1>

                <div class="card-deck mb-3">
                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-tradefair-1.jpg') }}" data-lightbox="image-1">
                            <div class="image" style="background: url('images/anp-tradefair-1.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>

                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-tradefair-2.jpg') }}" data-lightbox="image-2">
                            <div class="image" style="background: url('images/anp-tradefair-2.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>

                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-tradefair-3.jpg') }}" data-lightbox="image-3">
                            <div class="image" style="background: url('images/anp-tradefair-3.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>
                </div>

                <div><a class="btn btn-sm anp-btn px-4" href="">more here...</a></div>

                <h1 class="mt-5 mb-3 title-color">THE NEGROS SHOWROOM</h1>

                <div class="card-deck mb-3">
                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-showroom-1.jpg') }}" data-lightbox="image-1">
                            <div class="image" style="background: url('images/anp-showroom-1.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>

                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-showroom-2.jpg') }}" data-lightbox="image-2">
                            <div class="image" style="background: url('images/anp-showroom-2.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>

                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-showroom-3.jpg') }}" data-lightbox="image-3">
                            <div class="image" style="background: url('images/anp-showroom-3.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>
                </div>

                <div><a class="btn btn-sm anp-btn px-4" href="">more here...</a></div>

                <h1 class="mt-5 mb-3 title-color">PRODUCT GALLERY</h1>

                <div class="card-deck mb-3">
                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-product-1.jpg') }}" data-lightbox="image-1">
                            <div class="image" style="background: url('images/anp-product-1.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>

                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-product-2.jpg') }}" data-lightbox="image-2">
                            <div class="image" style="background: url('images/anp-product-2.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>

                    <div class="card image-box mb-2">
                        <a href="{{ asset('images/anp-product-3.jpg') }}" data-lightbox="image-3">
                            <div class="image" style="background: url('images/anp-product-3.jpg') no-repeat center; height: 200px; border-radius: 1px"></div>
                        </a>
                    </div>
                </div>

                <div><a class="btn btn-sm anp-btn px-4" href="">more here...</a></div>
            </div>
        </div>
    </div>
@endsection
