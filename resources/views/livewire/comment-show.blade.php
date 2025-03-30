<div>
    <h2 class="text-lg font-bold mb-4">Comments:</h2>

    @if ($comments->isEmpty())
        <p>No comments yet.</p>
    @else
        <ul class="space-y-4">
            @foreach ($comments as $comment)
                <li class="p-4 border rounded-lg shadow-sm">
                    <div class="flex items-start space-x-4">
                        <!-- Profile Image with Circle Shape, Right Margin, and Border -->
                        @if ($currentProfile && $currentProfile->profile_picture && file_exists(storage_path('app/public/' . $currentProfile->profile_picture)) && is_readable(storage_path('app/public/' . $currentProfile->profile_picture)))
                            <img src="{{ asset('storage/' . $currentProfile->profile_picture) }}" alt="Profile Picture" class="object-cover w-16 h-16 rounded-full border-2 border-blue-500">
                        @else
                            <div class="bg-gray-200 text-gray-500 flex items-center justify-center w-16 h-16 rounded-full border-2 border-blue-500">
                                N/A
                            </div>
                        @endif

                        <!-- Comment Content -->
                        <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div> <!-- Left side content -->
                                <span class="font-semibold">Client #{{ $comment->client_id }}</span>
                                <p class="text-yellow-500 mt-1">⭐ {{ $comment->rating }}/5</p>
                                <p class="text-gray-700 mt-1">{{ $comment->comment }}</p>
                            </div>

                            <div class="flex flex-col items-end"> <!-- Right side: Timestamp + Delete button -->
                                <span class="text-sm text-gray-600 mb-1">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>

                                @if (Auth::check() && Auth::user()->user_type === 'admin')
                                    <button wire:click="deleteComment({{ $comment->id }})"
                                            class="custom-button4">
                                        Delete
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    </div>
                </li>
            @endforeach
        </ul>
        
    @endif


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
                    <label class="block font-semibold">Rating:</label>
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



