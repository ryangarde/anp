@extends('admins.layouts.app')

@section('title', 'Messages')

@section('content')

<div class="card">
    <div class="card-header">
        {{ $message->name }}
    </div>
    <div class="card-body">
        <b>Email:</b> {{ $message->email }}
        <br><br>
        <b>Subject:</b> {{ $message->subject }}
        <br><br>
        <b>Message:</b> {{ $message->message }}
    </div>
    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
</div>

@endsection
