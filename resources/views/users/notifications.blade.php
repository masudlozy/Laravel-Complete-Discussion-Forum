@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Notifications</div>

    <div class="card-body">
        <ul class="list-group">
            @foreach ($notifications as $notification)
            <li class="list-group-item">
                @if ($notification->type === 'LaravelForum\Notifications\NewReplyAdded')
                    A new reply was added to
                    <strong>
                        {{ $notification->data['discussion']['title'] }}
                    </strong>
                <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}" class="float-right btn btn-sm btn-info">
                    View Discussion
                </a>
                @endif
                @if ($notification->type === 'LaravelForum\Notifications\ReplyMarkedAsBestReply')
                    Your reply was marked as best reply in
                    <strong>
                        {{ $notification->data['discussion']['title'] }}
                    </strong>
                <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}" class="float-right btn btn-sm btn-info">
                    View Discussion
                </a>
                @endif

            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
