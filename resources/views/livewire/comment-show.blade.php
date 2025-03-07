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

    <!-- Comment Form - Only for Authenticated Users with Booking -->
    @if ($canComment)
        <div class="mt-6 p-4 border rounded-lg shadow-md">
            <h3 class="text-lg font-bold mb-2">Leave a Comment</h3>

            @if (session()->has('success'))
                <p class="text-green-500">{{ session('success') }}</p>
            @endif

            @if (session()->has('error'))
                <p class="text-red-500">{{ session('error') }}</p>
            @endif

            <form wire:submit.prevent="submitComment">
                <textarea wire:model="commentText" class="w-full border rounded-lg p-2" placeholder="Write your comment..." required></textarea>
                
                <div class="mt-2">
                    <label class="block font-semibold">Rating (Optional):</label>
                    <select wire:model="rating" class="border p-2 rounded-lg">
                        <option value="">No rating</option>
                        <option value="1">⭐ 1</option>
                        <option value="2">⭐⭐ 2</option>
                        <option value="3">⭐⭐⭐ 3</option>
                        <option value="4">⭐⭐⭐⭐ 4</option>
                        <option value="5">⭐⭐⭐⭐⭐ 5</option>
                    </select>
                </div>

                <button type="submit" class="mt-3 bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
            </form>
        </div>
    @else
        <p class="mt-4 text-gray-500">Only clients who have booked this childminder can leave a comment.</p>
    @endif
</div>
