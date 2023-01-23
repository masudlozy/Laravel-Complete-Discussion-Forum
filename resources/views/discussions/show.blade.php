@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <img width="40px" height="40px" style="border-radius:50%"
                    src="{{ Gravatar::src($discussion->author->email) }}" alt="">
                <strong class="ml-2">{{ $discussion->author->name }}</strong>
            </div>
            <div>
                <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="text-center">
            <strong>
                {{ $discussion->title }}
            </strong>
        </div>
        <hr>
        {!! $discussion->content !!}

        @if ($discussion->bestReply)
            <div class="card bg-success my-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img width="40px" height="40px" style="border-radius: 50%" src="{{ Gravatar::src($discussion->bestReply->owner->email) }}"
                                alt="">
                            <strong class="ml-2">
                                {{ $discussion->bestReply->owner->name }}
                            </strong>
                        </div>
                        <div>
                            Best Reply
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $discussion->bestReply->content !!}
                </div>
            </div>
        @endif
    </div>
</div>

@foreach ($discussion->replies()->paginate(3) as $reply)
<div class="card my-5">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <img width="40px" height="40px" style="border-radius: 50%" src="{{ Gravatar::src($reply->owner->email) }}" alt="">
                <span class="ml-2">{{ $reply->owner->name }}</span>
            </div>
            <div>
               @auth
                   @if (auth()->user()->id === $discussion->user_id)
                    <form action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}"
                        method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">Mark as best reply</button>
                    </form>
                    @endif
               @endauth
            </div>
        </div>
    </div>
    <div class="card-body">
        {!! $reply->content !!}
    </div>
</div>
@endforeach

{{ $discussion->replies()->paginate(3)->links() }}

<div class="card my-5">
    <div class="card-header">
        Add a reploy
    </div>
    <div class="card-body">
    @auth
    <form action="{{ route('replies.store', $discussion->slug) }}" method="post">
                @csrf
                <input type="hidden" name="content" id="content">
                <trix-editor input="content"></trix-editor>
                <button class="btn btn-success btn-sm my-2" type="submit"> Add Reploy</button>
            </form>
    @else
        <a class="btn btn-info" href="{{ route('login') }}">Sing in to add a reploy</a>
    @endauth
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection
