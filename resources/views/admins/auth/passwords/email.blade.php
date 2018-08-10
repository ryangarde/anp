@extends('admins.layouts.app')

@section('title', 'Request Change Password')

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
        <form class="form-horizontal" method="POST" action="{{ route('admin.send-reset-link-email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>

                <input id="email" type="email" class="form-control" name="email" value="" required>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm">
                Send Password Reset Link
            </button>
        </form>
    </div>
</div>
@endsection
