@extends('admins.layouts.app')

@section('title', 'View Admin')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admins.index') }}">Admins</a>
    <a class="breadcrumb-item" href="{{ route('admins.show',$admin->id) }}">View Admin</a>
    <span class="breadcrumb-item">Edit Admin</span>
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
    <form method="POST" action="{{ route('admins.update',$admin->id) }}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <textarea class="form-control" id="email" name="email" >{{ $admin->email }}</textarea>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm" style="cursor: pointer;">Update</button>
        </div>
    </form>
</div>
@endsection
