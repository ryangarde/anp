@extends('users.layouts.app')

@section('title', 'Shop')

@section('content')

<div style="position: relative; width: 100%; height: 100%;">
    <img class="img-fluid" src="{{ asset('images/contact-us-banner-300.jpg') }}">
    <div class="shop-header-cover">
        <h1 class="shop-header-cover-title">Contact Us</h1>
    </div>
</div>
<div class="d-flex align-content-center justify-content-center text-center">
    @if (Request::is('v2') || Request::is('v2/shop'))
        @include('users.layouts.navbar-v2')
    @else
        @include('users.layouts.navbar')
    @endif
</div>

<div class="container mb-5 mt-4 pt-3">
    <br>
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-color-theme">Our Address</h3>
            <br>
            <h5 class="text-color-secondary">The Negros Showroom</h5>
            <p>
                <i class="fa fa-map-marker text-color-theme"></i> &nbsp;Central City Walk, Robinsons Place Bacolod, Lacson Street, Mandalagan,
                <br>
                Bacolod City, Negros Occidental, Philippines
            </p>

            <br>

            <h5 class="text-color-secondary">Office/Mailing Address</h5>
            <p>
                <i class="fa fa-map-marker text-color-theme"></i> &nbsp;Room 301, A – Chan Bldg., 97 Lacson St. Mandalagan, Bacolod City, 6100
                <br>
                Negros Occidental, Philippines
            </p>

            <br>
        </div>
        <div class="col-md-6">
            <h3 class="text-color-theme">We Will Call You Back</h3>
            <p>
                Your questions and comments are important to us.
                <br>
                Just fill-up the form below and we'll respond as soon as we can.
            </p>

            <form method="POST" action="/contact-us">
                {{ csrf_field() }}
                <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                    <div class="col-sm-9">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('subject') ? 'has-error' : '' }}">
                    <label for="subject" class="col-sm-3 col-form-label">Subject</label>
                    <div class="col-sm-9">
                        <input id="email" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
                        @if ($errors->has('subject'))
                        <span class="help-block">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('message') ? 'has-error' : '' }}">
                    <label for="message" class="col-sm-3 col-form-label">Message</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="message" value="{{ old('message') }}" required autofocus></textarea>
                        @if ($errors->has('message'))
                        <span class="help-block">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-sm btn-theme-color">
                            <i class="fa fa-paper-plane"></i> &nbsp;Send Message
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <hr class="breaker">

    <h3 class="text-color-theme">Contact Details</h3>

    <br>

    <div class="row">
        <div class="col-md-4">
            <h5 class="text-color-secondary">Mailing Address</h5>
            <p>
                <i class="fa fa-address-book text-color-theme"></i> &nbsp;Room 301, A – Chan Bldg., 97 Lacson St. Mandalagan, Bacolod City, 6100
                <br>
                Negros Occidental, Philippines
            </p>
        </div>
        <div class="col-md-4">
            <h5 class="text-color-secondary">E-mail</h5>
            <p>
                <i class="fa fa-envelope text-color-theme"></i> &nbsp;anp@anp-philippines.com
                <br>
                <i class="fa fa-envelope text-color-theme"></i> &nbsp;salesmarketing@anp-philippines.com
                <br>
                <i class="fa fa-envelope text-color-theme"></i> &nbsp;membership@anp-philippines.com
            </p>
        </div>
        <div class="col-md-4">
            <h5 class="text-color-secondary">Phone</h5>
            <p>
                <i class="fa fa-phone text-color-theme"></i> &nbsp;+63 34 434.1000
                <br>
                <i class="fa fa-phone text-color-theme"></i> &nbsp;+63 34 433.8833
            </p>
        </div>
    </div>

    <hr class="breaker">

    <h3 class="text-color-theme">Location</h3>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15682.21688108845!2d122.9578927!3d10.691668!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xca025356ff98b723!2sNegros+Showroom!5e0!3m2!1sen!2sph!4v1514486491768" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
