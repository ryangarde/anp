@extends('admins.layouts.app')

@section('title', 'Category List')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Categories</a>
    <span class="breadcrumb-item">Category List</span>
</nav>

<div class="card">
    <div class="card-header">
        Category List
        <a href="{{ route('categories.create') }}" class="float-right btn btn-success btn-sm">Create New Category</a>
    </div>
    <div class="card-body">
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        <br>
        @endif
        <div class="row">
            <div class="col-md-9">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Options</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td><a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>

                {{ $categories->links() }}
            </div>

            <div class="col-md-3" style="border-left: 1px solid #eee;">
                <form action="{{ $searchUrl }}" method="POST" accept-charset="utf-8">
                    {{ csrf_field() }}
                    {{ method_field('GET') }}

                    <div class="form-group">
                        <label class="sr-only" for="searchColumnName">Name</label>
                        <input type="search" class="form-control form-control-sm" id="searchColumnName" name="searchColumnName" placeholder="Search Name" value="{{ request()->searchColumnName }}" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="searchColumnDescription">Description</label>
                        <textarea class="form-control form-control-sm" id="searchColumnDescription" name="searchColumnDescription" placeholder="Search Description">{{ request()->searchColumnDescription }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    </div>
                </form>
                {{-- @include('admins.layouts.archives') --}}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
</div>
@endsection
