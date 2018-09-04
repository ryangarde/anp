@extends('admins.layouts.app')

@section('title', 'Create New Retail Size')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Retail Sizes</a>
    <span class="breadcrumb-item">Create New Retail Size</span>
</nav>

<div class="card">
    <div class="card-header">
        Create New Retail Size
    </div>
    <div class="card-body">
        <form method="POST" action="/retail" accept-charset="utf-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Retail Size</label>
                <input type="text" class="form-control" name="name" id="name" autocomplete="off" required>
                @if ($errors->has('name'))
                <span class="help-block error">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm">Create New Retail Size</button>
        </form>

    </div>
</div>
@endsection
