@extends('admins.layouts.app')

@section('title','Create Report')

@section('content')


<div class="card">
    <div class="card-header">
        Create Report
    </div>
    <form method="POST" action="{{ route('admins.reports.export') }}" accept-charset="utf-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="date_from">Order date from:</label>
                        <input type="date" class="form-control" name="date_from" id="date_from" autocomplete="off" >
                    </div>
                    <div class="col-md-3">
                        <label for="date_to">Order date to:</label>
                        <input type="date" class="form-control" name="date_to" id="date_to" autocomplete="off" >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="producer">Producer</label>
                        <select class="form-control" id="producer_id" name="producer_id">
                            <option value="all">All</option>
                            @foreach ($producers as $producer)
                            <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="product">Product</label>
                        <select class="form-control" id="product_id" name="product_id">
                            <option value="all">All</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="producer">Customer</label>
                        <select class="form-control" id="user_id" name="user_id">
                            <option value="all">All</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user_id') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="product">Admin</label>
                        <select class="form-control" id="admin_id" name="admin_id">
                            <option value="all">All</option>
                            @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('admin_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('admin_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm" style="cursor: pointer;">
                Create Report
            </button>
        </div>
    </form>
</div>



@endsection

