@extends('admins.layouts.app')

@section('title', 'Create New Product')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Products</a>
    <span class="breadcrumb-item">Create New Product</span>
</nav>

<div class="card">
    <div class="card-header">
        Create New Product
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('products.store') }}" accept-charset="utf-8" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id="image" autocomplete="off" required>
                @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="producer_id">Producer</label>
                <select class="form-control" id="producer_id" name="producer_id">
                    @foreach ($producers as $producer)
                    <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('producer_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('producer_id') }}</strong>
                </span>
                @endif
            </div>

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

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_id') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" autocomplete="off" required>
                @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
                <button type="submit" class="btn btn-primary btn-sm">Create New Producer</button>
            </div>
        </form>
    </div>
</div>
@endsection
