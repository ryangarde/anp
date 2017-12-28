@extends('users.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid" style="background: url('/images/home-banner.jpg') no-repeat top/cover; height: 600px">

    </div>
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
                            <div>&rsaquo; DOST Dungog S&T - 2016</div>
                            <div>Outstanding Bacolod Business Support Organization - 2007</div>
                            <div>DTI and PRA Outstanding Filipino Retailers - 2008</div>
                            <div>Outstanding non-government organization</div>
                            <div>Outstanding Kabisig-Type Project (Micro Lending Project)</div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">


            </div>
        </div>
    </div>
@endsection
