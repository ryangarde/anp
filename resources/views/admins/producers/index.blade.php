@extends('admins.layouts.app')

@section('title', 'Producer List')

@section('content')
<div>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="#">Producers</a>
        <span class="breadcrumb-item">Producer List</span>
    </nav>

    <div class="card">
        <div class="card-header">
            Producer List
            <a href="{{ route('producers.create') }}" class="float-right btn btn-success btn-sm">Create New Producer</a>
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
                    <table class="table table-hover table-producer">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Website</th>
                                <th>Options</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($producers as $producer)
                            <tr>
                                <td class="name">{{ $producer->name }}</td>
                                <td class="website">{{ $producer->website }}</td>
                                <td class="options"><a href="{{ route('producers.show', $producer->id) }}" class="btn btn-info btn-sm">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br>

                    {{ $producers->links() }}
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
                            <label class="sr-only" for="searchColumnWebsite">Website</label>
                            <input type="search" class="form-control form-control-sm" id="searchColumWebsite" name="searchColumWebsite" placeholder="Search Website" value="{{ request()->searchColumnWebsite }}" autocomplete="off">
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
</div>
@endsection


