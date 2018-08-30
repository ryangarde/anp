@extends('admins.layouts.app')

@section('title', 'View Retail Size')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Retail Sizes</a>
    <a class="breadcrumb-item" href="/retail">Retail Sizes List</a>
    <span class="breadcrumb-item">View Retail Size</span>
</nav>

<div class="card">
    <div class="card-header">
        View Retail Size
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="retailSize">Retail Size</label>
            <input type="text" name="retailSize" class="form-control" value="{{ $retailSize->name }}" disabled>
        </div>
        <form method="POST" action="{{ route('admins.retailSizes.destroy',$retailSize->id) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <a href="{{ route('admins.retailSizes.edit',$retailSize->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>

</div>

@endsection
