@extends('layouts.app')

@section('content')

    <div class="card">
        @include('partials.discussion-header')
        <div class="card-body">
            <div class="text-center">
                <strong> {{ $discussion->title }}</strong>
            </div>

            <hr>

            {!! $discussion->content !!}

            @if ($discussion->bestReply)
                <div class="card text-white bg-success my-5">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <img class="rounded-circle" width="40px" height="40px"
                                    src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" alt="">
                                <strong class="ml-2">{{ $discussion->bestReply->owner->name }}</strong>
                            </div>
                            <div class="">
                                <strong>Best Reply</strong>
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
                        <img src="{{ Gravatar::src($reply->owner->email) }}" class="rounded-circle" height="40px"
                            width="40px" alt="">
                        <span class="ml-2">{{ $reply->owner->name }}</span>
                    </div>
                    <div>
                        @auth
                            @if (auth()->user()->id == $discussion->user_id)
                                <form
                                    action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}"
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
            Add a reply
        </div>

        <div class="card-body">
            @auth
                <form action="{{ route('replies.store', $discussion->slug) }}" method="post">
                    @csrf
                    <input type="hidden" name="content" id="content">
                    <trix-editor input="content"></trix-editor>

                    <button class="btn btn-success btn-sm  my-2">Add Reply</button>
                </form>
            @else
                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-info text-white">Sign in to add a reply</a>
                </div>
            @endauth
        </div>
    </div>

@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" />
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
