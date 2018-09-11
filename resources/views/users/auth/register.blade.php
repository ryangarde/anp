@extends('users.layouts.app')

@section('title', 'Register')

@section('content')
<div class="container content">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="card mb-5 mt-3 custom-card-login">
                <div class="card-header">
                    Register
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                <span class="help-block error">
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
                                <span class="help-block error">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('street') ? 'has-error' : '' }}">
                            <label for="lot_block" class="col-sm-3 col-form-label">Lot/Blk No.<small class="text-info"><strong>*Optional</strong></small></label>
                            <div class="col-sm-3">
                                <input id="lot_block" type="text" class="form-control" name="lot_block" value="{{ old('lot_block') }}" autofocus>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="street" class="col-xs-2 col-form-label">Street</label>
                            <div class="col-sm-5">
                                <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}" autofocus>
                                @if ($errors->has('street'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('street') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('subdivision_barangay') ? 'has-error' : '' }}">
                            <label for="subdivision_barangay" class="col-sm-3 col-form-label">Subdivision / Barangay<br><small class="text-info"><strong>*Seperate with a comma</strong></small></label>

                            <div class="col-sm-9">
                                <input id="subdivision_barangay" type="text" class="form-control" name="subdivision_barangay" value="{{ old('subdivision_barangay') }}" autofocus>
                                @if ($errors->has('subdivision_barangay'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('subdivision_barangay') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('city_municipality') ? 'has-error' : '' }}">
                            <label for="city_/_municipality" class="col-sm-3 col-form-label">City / Municipality</label>
                            <div class="col-sm-9">
                                <input id="city_municipality" type="text" class="form-control" name="city_municipality" value="{{ old('city_municipality') }}" autofocus>
                                @if ($errors->has('city_municipality'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('city_municipality') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('province') ? 'has-error' : '' }}">
                            <label for="province" class="col-sm-3 col-form-label">Province</label>
                            <div class="col-sm-9">
                                <input id="province" type="text" class="form-control" name="province" value="{{ old('province') }}" autofocus>
                                @if ($errors->has('province'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('province') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('phone_number') ? 'has-error' : '' }} {{ $errors->has('zip_code') ? 'has-error' : '' }}">
                            <label for="zip_code" class="col-sm-3 col-form-label">Zip Code</label>
                            <div class="col-sm-2">
                                <input id="zip_code" type="number" class="form-control" name="zip_code" value="{{ old('zip_code') }}" autofocus>
                                @if ($errors->has('zip_code'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('zip_code') }}</strong>
                                </span>
                                @endif
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="phone_number" class="col-xs-3 col-form-label">Phone Number</label>
                            <div class="col-sm-5">
                                <input id="phone_number" type="number" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autofocus>
                                @if ($errors->has('phone_number'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>
                                @if ($errors->has('password'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autofocus>
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block error">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn anp-btn btn-sm" style="cursor: pointer;">
                                    Register
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a href="/login">Already have an account?</a>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
