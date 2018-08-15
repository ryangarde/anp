@extends('admins.layouts.app')

@section('title', 'Messages')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Messages</a>
    <span class="breadcrumb-item">Message List</span>
</nav>
<div class="card">
    <div class="card-header">
        Messages
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>
                        <a href="/messages/{{ $message->id }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
</div>

@endsection
