@extends('admins.layouts.app')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Profile</a>
    <span class="breadcrumb-item">Request Change Password</span>
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
        <form class="form-horizontal" method="POST" action="{{ route('admins.store') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name</label>

                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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

            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                Register New Admin
            </button>
        </form>
    </div>
</div>
@endsection
