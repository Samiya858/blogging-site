<h3 class="font-semibold">Comments</h3>

@foreach($post->comments()->where('status', 'approved')->get() as $comment)
    <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
@endforeach
