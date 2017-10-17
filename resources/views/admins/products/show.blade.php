@extends('admins.layouts.app')

@section('title', 'View Product')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Products</a>
    <span class="breadcrumb-item">View Product</span>
</nav>

<div class="card">
    <div class="card-header clearfix">
        View Product
        @if (session('message'))
        <div class="float-right text-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="card-body">
        <fieldset disabled>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id="image" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="producer_id">Producer</label>
                <select class="form-control" id="producer_id" name="producer_id">
                    @foreach ($producers as $producer)
                    <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" autocomplete="off" required>
            </div>
        </fieldset>
        <div class="form-group">
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">Back</a>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
