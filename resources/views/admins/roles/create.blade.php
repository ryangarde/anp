@extends('admins.layouts.app')

@section('title', 'Dashboards - Create New Role')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Roles</a>
    <span class="breadcrumb-item">Create New Role</span>
</nav>

<div class="card">
    <div class="card-header">
        Create New Role
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('roles.store') }}" accept-charset="utf-8">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" autocomplete="off" required>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="display">Display Name</label>
                <input type="text" class="form-control" name="display_name" id="display_name" autocomplete="off" required>
                @if ($errors->has('display_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('display_name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm">Create New Role</button>
        </form>
    </div>
</div>
@endsection
