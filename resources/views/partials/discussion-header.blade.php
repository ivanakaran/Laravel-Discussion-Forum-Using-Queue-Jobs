<div class="card-header">
    <div class="d-flex justify-content-between">
        <div class="">
            <img src="{{ Gravatar::src($discussion->author->email) }}" class="rounded-circle" width="40px" alt="">
            <span class="ml-2 font-weight-bold">{{ $discussion->author->name }}</span>
        </div>
        <div class="">
            <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
        </div>
    </div>
</div>
