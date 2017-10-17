@extends('admins.layouts.app')

@section('title', 'Edit Producer')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Producers</a>
    <span class="breadcrumb-item">Edit Producer</span>
</nav>

<div class="card">
    <div class="card-header">
        Edit Producer
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('producers.update', $producer->id) }}" accept-charset="utf-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" autocomplete="off" value="{{ $producer->name }}" required>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="website">Website <small class="text-warning"><strong>*Optional</strong></small></label>
                <input type="text" class="form-control" name="website" id="website" autocomplete="off" value="{{ $producer->website }}" required>
                @if ($errors->has('website'))
                <span class="help-block">
                    <strong>{{ $errors->first('website') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
                <button type="submit" class="btn btn-primary btn-sm">Update Producer</button>
            </div>
        </form>
    </div>
</div>
@endsection
