@extends('admins.layouts.app')

@section('title', 'Edit Product')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Products</a>
    <span class="breadcrumb-item">Edit Product</span>
</nav>

<div class="card">
    <div class="card-header">
        Edit Product
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('products.update', $product->id) }}" accept-charset="utf-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="image">Image <small class="text-info"><strong>*Optional, leave blank if you don't want to update the image</strong></small></label>
                <input type="file" class="form-control-file" name="image" id="image" autocomplete="off">
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
                    @if ($producer->id == $product->producer->id)
                    <option value="{{ $producer->id }}" selected>{{ $producer->name }}</option>
                    @else
                    <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                    @endif
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
                <input type="text" class="form-control" name="name" id="name" autocomplete="off" value="{{ $product->name }}" required>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5">{{ $product->description }}</textarea>
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
                    @if ($category->id == $product->category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
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
                <input type="text" class="form-control" name="price" id="price" autocomplete="off" value="{{ $product->price }}" required>
                @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="retail_size_id">Retail Size</label>
                <select class="form-control" id="retail_size_id" name="retail_size_id">
                    @foreach ($retailSizes as $retailSize)
                    <option value="{{ $retailSize->id }}">{{ $retailSize->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('retail_size_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('retail_size_id') }}</strong>
                </span>
                @endif
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm">Update Product</button>
        </form>
    </div>
</div>
@endsection
