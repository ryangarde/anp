@extends('admins.layouts.app')

@section('title', 'Dashboards - Edit Role')

@section('content')
<h1>Edit Role</h1>

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<form role="form" method="POST" action="{{ route('roles.update', $role->id) }}" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" autocomplete="off" required value="{{ $role->name }}">
        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <label for="display_name">Display Name</label>
        <input type="text" class="form-control" name="display_name" id="display_name" autocomplete="off" required value="{{ $role->display_name }}">
        @if ($errors->has('display_name'))
        <span class="help-block">
            <strong>{{ $errors->first('display_name') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="10">{{ $role->description }}</textarea>
        @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
        <button type="submit" class="btn btn-primary btn-sm">Update Role</button>
    </div>
</form>
@endsection
