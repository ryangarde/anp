@extends('users.layouts.app')

@section('title', 'Register')

@section('content')
<div class="container content">
    <div class="row">
        <div class="col-md-6 mx-auto">
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

                        <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>
                                @if ($errors->has('password'))
                                <span class="help-block">
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
                                <span class="help-block">
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
                                <button type="submit" class="btn btn-theme-color btn-sm">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
