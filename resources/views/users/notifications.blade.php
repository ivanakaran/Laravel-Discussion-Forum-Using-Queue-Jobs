@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Notifications') }}</div>
        <div class="card-body">
            <ul class="list-group">

                @foreach ($notifications as $notification)

                    @if ($notification->type == 'App\Notifications\NewReplyAdded')
                        <li class="list-item mb-2">
                            A new reply was added to your discussion
                            <strong>
                                {{ $notification->data['discussion']['title'] }}
                            </strong>
                            <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}"
                                class="btn btn-sm btn-info float-right">
                                View discussion
                            </a>
                        </li>
                    @endif
                    @if ($notification->type == 'App\Notifications\ReplyMarkedAsBestReply')
                        <li class="list-item mb-2">
                            Your reply to the discussion
                            <strong>
                                {{ $notification->data['discussion']['title'] }}
                            </strong>
                            was marked as best reply
                            <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}"
                                class="btn btn-sm btn-info float-right">
                                View discussion
                            </a>
                        </li>
                    @endif

                @endforeach

            </ul>

        </div>
    </div>
@endsection
