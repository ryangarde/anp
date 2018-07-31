@extends('admins.layouts.app')

@section('title', 'Profile')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Profile</a>
    <span class="breadcrumb-item">View Profile</span>
</nav>

<div class="card">
    <div class="card-header">
        View Profile
        @if (session('message'))
        <div class="float-right text-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admins.update', $admin->id) }}" accept-charset="utf-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $admin->email }}" disabled>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>
            <a href="{{ route('admin.show-link-request-form') }}" class="btn btn-info btn-sm">Change Password</a>
        </form>
    </div>
</div>
@endsection
