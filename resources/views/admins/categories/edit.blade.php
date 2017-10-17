@extends('admins.layouts.app')

@section('title', 'Edit Category')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Categories</a>
    <span class="breadcrumb-item">Edit Category</span>
</nav>

<div class="card">
    <div class="card-header">
        Edit Category
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('categories.update', $category->id) }}" accept-charset="utf-8">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" autocomplete="off" value="{{ $category->name }}" required>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5">{{ $category->description }}</textarea>
                @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
                <button type="submit" class="btn btn-primary btn-sm">Update Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
