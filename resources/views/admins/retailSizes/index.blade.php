@extends('admins.layouts.app')

@section('title', 'Retail Size List')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Retail Sizes</a>
    <span class="breadcrumb-item">Retail Sizes List</span>
</nav>

<div class="card">
    <div class="card-header">
        Retail Size List
        <a href="{{ route('admins.retailSizes.create') }}" class="float-right btn btn-success btn-sm">Create Retail Size</a>
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
                        @foreach ($retailSizes as $retailSize)
                        <tr>
                            <td>{{ $retailSize->name }}</td>
                            <td><a href="{{ route('admins.retailSizes.show', $retailSize->id) }}" class="btn btn-info btn-sm">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>
                <div class="mx-auto mt-4" style="width: 50px;">
                    {{ $retailSizes->links('vendor.pagination.bootstrap-4') }}
                </div>
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
