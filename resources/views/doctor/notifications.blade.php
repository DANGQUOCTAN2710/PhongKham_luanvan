@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Thông báo</h2>

    <ul class="list-group">
        @foreach($notifications as $notification)
            <li class="list-group-item {{ $notification->read_at ? '' : 'bg-light' }}">
                <p><strong>{{ $notification->title }}</strong></p>
                <p>{{ $notification->message }}</p>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </li>
        @endforeach
    </ul>
</div>
@endsection
