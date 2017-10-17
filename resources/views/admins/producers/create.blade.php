@extends('admins.layouts.app')

@section('title', 'Create New Producer')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Producers</a>
    <span class="breadcrumb-item">Create New Producer</span>
</nav>

<div class="card">
    <div class="card-header">
        Create New Producer
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('producers.store') }}" accept-charset="utf-8" enctype="multipart/form-data">
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
                <label for="website">Website <small class="text-warning"><strong>*Optional</strong></small></label>
                <input type="text" class="form-control" name="website" id="website" autocomplete="off" required>
                @if ($errors->has('website'))
                <span class="help-block">
                    <strong>{{ $errors->first('website') }}</strong>
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
