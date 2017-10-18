@extends('admins.layouts.app')

@section('title', 'Create New Category')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Categories</a>
    <span class="breadcrumb-item">Create New Category</span>
</nav>

<div class="card">
    <div class="card-header">
        Create New Category
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('categories.store') }}" accept-charset="utf-8" enctype="multipart/form-data">
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
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm">Create New Category</button>
        </form>
    </div>
</div>
@endsection
