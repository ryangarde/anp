@extends('admins.layouts.app')

@section('title', 'Reset Password')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Profile</a>
    <span class="breadcrumb-item">Reset Password</span>
</nav>

<div class="card">
    <div class="card-header">
        Request Change Password
        @if (session('status'))
        <div class="float-right text-success">
            {{ session('status') }}
        </div>
        @endif
    </div>
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('admin.show-link-request-form') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>

                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection
