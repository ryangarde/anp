@extends('admins.layouts.app')

@section('title', 'View Admin')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Admins</a>
    <span class="breadcrumb-item">View Admin</span>
</nav>

<div class="card">
    <div class="card-header clearfix">
        View Admin
        @if (session('message'))
        <div class="float-right text-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="card-body">
        <fieldset disabled>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="{{ $admin->name }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <textarea class="form-control" id="email">{{ $admin->email }}</textarea>
            </div>
        </fieldset>
    </div>
</div>
@endsection
