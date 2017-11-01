@extends('admins.layouts.app')

@section('title', 'Admin List')

@section('content')
<div>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="#">Admins</a>
        <span class="breadcrumb-item">Admin List</span>
    </nav>

    <div class="card">
        <div class="card-header">
            Admin List
            <a href="{{ route('admins.create') }}" class="float-right text-success">Add New Admin</a>
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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Options</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                {{-- <td><a href="{{ route('admin.show', $category->id) }}" class="btn btn-info btn-sm">View</a></td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br>

                    {{ $admins->links() }}
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
                            <label class="sr-only" for="searchColumnEmail">Email</label>
                            <input type="search" class="form-control form-control-sm" id="searchColumnEmail" name="searchColumnEmail" placeholder="Search Email" value="{{ request()->searchColumnEmail }}" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        </div>
                    </form>
                    {{-- @include('admins.layouts.archives') --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
