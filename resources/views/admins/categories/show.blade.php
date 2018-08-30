@extends('admins.layouts.app')

@section('title', 'View Category')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Categories</a>
    <span class="breadcrumb-item">View Category</span>
</nav>

<div class="card">
    <div class="card-header clearfix">
        View Category
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
                <input type="text" class="form-control" id="name" value="{{ $category->name }}">
            </div>

            {{-- <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description">{{ $category->description }}</textarea>
            </div> --}}
        </fieldset>
    </div>
    <div class="card-footer">
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" accept-charset="utf-8">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">Back</a>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>
</div>
@endsection
