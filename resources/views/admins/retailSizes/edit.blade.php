@extends('admins.layouts.app')

@section('title', 'View Retail Size')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Retail Sizes</a>
    <a class="breadcrumb-item" href="/retail">Retail Sizes List</a>
    <a class="breadcrumb-item" href="/retail/{{ $retailSize->id }}">View Retail Size</a>
    <span class="breadcrumb-item">Edit Retail Sizes</span>
</nav>

<div class="card">
    <div class="card-header">
        View Retail Size
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admins.retailSizes.update',$retailSize->id) }}" accept-charset="utf-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="name">Retail Size</label>
                <input type="text" class="form-control" name="name" id="name" autocomplete="off" value="{{ $retailSize->name }}" required>
                @if ($errors->has('name'))
                <span class="help-block error">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
    </div>

</div>

@endsection
