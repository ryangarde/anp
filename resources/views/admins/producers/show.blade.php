@extends('admins.layouts.app')

@section('title', 'View Producer')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Producers</a>
    <span class="breadcrumb-item">View Producer</span>
</nav>

<div class="card">
    <div class="card-header clearfix">
        View Producer
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
                <input type="text" class="form-control" value="{{ $producer->name }}">
            </div>

            <div class="form-group">
                <label for="website">Website</label>
                <div class="input-group">
                    <div class="input-group-addon"><a class="text-success" href="{{ $producer->website }}" target="_blank">Visit</a></div>
                    <input type="text" class="form-control" value="{{ $producer->website }}">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="10">{{ $producer->description }}</textarea>
            </div>
        </fieldset>

        <form action="{{ route('producers.destroy', $producer->id) }}" method="POST" accept-charset="utf-8">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <a href="{{ route('producers.index') }}" class="btn btn-secondary btn-sm">Back</a>
            <a href="{{ route('producers.edit', $producer->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>

    </div>
</div>
@endsection
