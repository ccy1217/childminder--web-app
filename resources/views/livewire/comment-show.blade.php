<div>
    <h2 class="text-lg font-bold mb-4">Comments:</h2>

    @if ($comments->isEmpty())
        <p>No comments yet.</p>
    @else
        <ul class="space-y-4">
            @foreach ($comments as $comment)
                <li class="p-4 border rounded-lg shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Client #{{ $comment->client_id }}</span>
                        <span class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700">{{ $comment->comment }}</p>
                    @if ($comment->rating)
                        <p class="text-yellow-500">Rating: ⭐{{ $comment->rating }}/5</p>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-4">
        {{ $comments->links() }}
    </div>
</div>
