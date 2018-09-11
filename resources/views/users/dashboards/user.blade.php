@extends('users.layouts.app-dashboard')

@section('title', 'Dashboard | Account Information')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-item">Account Information</span>
</nav>

<div class="d-flex align-content-center justify-content-center text-center">
    @if (Request::is('v2') || Request::is('v2/shop'))
        @include('users.layouts.navbar-v2')
    @else
        @include('users.layouts.navbar')
    @endif
</div>

<div class="card">
    <div class="card-header" style="text-align: center;">
        Personal Profile
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if(! empty(auth()->user()->image))
                    <img src="{{ auth()->user()->image }}">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" class="profile-img">
                @endif
                <form method="POST" action="{{ route('dashboard.user.upload', auth()->user()->id) }}" accept-charset="utf-8" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="image"><small class="text-info"><strong>*Optional, leave blank if you don't want to update the image</strong></small></label>
                        <div class="custom-file">
                            <input type="file" class="form-control-file" name="image" id="image" autocomplete="off">
                        </div>
                        @if ($errors->has('image'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                        @endif
                    </div>
                    <button type="submit" class="btn anp-btn upload-img-btn btn-sm">Upload Image</button>
                </form>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <br>
                <b class="text-color-theme">Name: </b>{{ auth()->user()->name }}<a href=""></a><br><br>
                <b class="text-color-theme">Email Address: </b>{{ auth()->user()->email }}<br><br>
                <b class="text-color-theme">Phone Number: </b>{{ auth()->user()->phone_number }}<br><br>
                <b class="text-color-theme">Address: </b>
                    @if(auth()->user()->lot_block)
                        {{ auth()->user()->lot_block }},
                    @endif
                    @if(str_contains(strtolower(auth()->user()->street),['street','st','st.']))
                        {{ auth()->user()->street }},
                    @else
                        {{ auth()->user()->street }} Street,
                    @endif

                    @if(str_contains(strtolower(auth()->user()->subdivision_barangay), [',']))
                        @if(str_contains(strtolower(substr(auth()->user()->subdivision_barangay,0,strpos(auth()->user()->subdivision_barangay,','))),['subdivision','subd']))
                        {{ substr(auth()->user()->subdivision_barangay,0,strpos(auth()->user()->subdivision_barangay,',')+1) }}
                        @else
                        {{ substr(auth()->user()->subdivision_barangay,0,strpos(auth()->user()->subdivision_barangay,',')+1) }} Subdivision
                        @endif
                    @endif
                    @if(str_contains(strtolower(auth()->user()->subdivision_barangay),['barangay','brgy','bgy']))
                        {{ substr(auth()->user()->subdivision_barangay, strpos(auth()->user()->subdivision_barangay,',')+1) }},
                    @else
                        Barangay {{ substr(auth()->user()->subdivision_barangay, strpos(auth()->user()->subdivision_barangay,',')+1) }},
                    @endif
                    {{ auth()->user()->city_municipality }},
                    {{ auth()->user()->province }},
                    {{ auth()->user()->zip_code }}<br><br>
                <a href="{{ route('dashboard.user.edit',auth()->user()->id) }}" class="btn anp-btn edit-profile-btn btn-sm">Edit Profile</a>

                <form method="POST" action="{{ route('dashboard.user.update',auth()->user()->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    @include('users.modals.edit-address')
                </form>

            </div>
        </div>

    </div>
</div>

@endsection
