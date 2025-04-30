<div class="p-4">
    @if ($bookings->isEmpty())
        <p>No bookings available.</p>
    @else
        <h2 class="font-semibold text-2xl mb-6 underline">Your Booking History</h2>

        <!-- Pending Bookings -->
        <h3 class="font-semibold text-lg mt-4 border-b-2 pb-2 mb-4 text-blue-500">Pending Bookings</h3>
        <div class="space-y-4">
            @foreach($bookings as $booking)
                @if($booking->status == 'Pending')
                    <div class="border p-4 rounded-lg">
                        <h3 class="text-lg font-medium">
                            Childminder ID: {{ $booking->childminder_id }} - 
                            {{ optional($booking->childminderprofile)->first_name ?? 'Unknown' }} 
                            {{ optional($booking->childminderprofile)->last_name ?? 'Childminder' }}
                        </h3>
                        <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</p>
                        <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</p>
                        <p><strong>Notes:</strong> {{ $booking->notes ?? 'No notes provided' }}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Accepted Bookings -->
        <h3 class="font-semibold text-lg mt-4 border-b-2 pb-2 mb-4 text-blue-500">Accepted Bookings</h3>
        <div class="space-y-4">
        @forelse($bookings->where('status', 'Confirmed') as $booking)
                <div class="border p-4 rounded-lg flex justify-between items-start">
                    <!-- Content aligned to the left -->
                    <div class="flex-1">
                        <h3 class="text-lg font-medium">
                            Childminder ID: {{ $booking->childminder_id }} -  
                            {{ optional($booking->childminderprofile)->first_name ?? 'Unknown' }} 
                            {{ optional($booking->childminderprofile)->last_name ?? 'Childminder' }}
                            @if (in_array($booking->childminderprofile->user_id, $unreadMessageUserIds))
                                🔔
                            @endif

                        </h3>
                        <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</p>
                        <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</p>
                        <p><strong>Notes:</strong> {{ $booking->notes ?? 'No notes provided' }}</p>
                        <span class="text-sm text-red-500">Booking confirmed.</span>
                    </div>

                    <!-- Message button aligned to the right -->
                    <div class="flex-shrink-0 ml-4">
                        <button wire:click="openMessageBoard(
                            {{ auth()->user()->id }},
                            {{ $booking->client_id }},
                            '{{ auth()->user()->clientprofile->first_name ?? 'Unknown' }}',
                            '{{ auth()->user()->clientprofile->last_name ?? 'Unknown' }}',
                            {{ $booking->childminder_id }},
                            {{ $booking->childminderprofile->user_id ?? 'null' }},
                            '{{ $booking->childminderprofile->first_name ?? 'Unknown' }}',
                            '{{ $booking->childminderprofile->last_name ?? 'Unknown' }}',
                            {{ $booking->childminderprofile->user_id ?? 'null' }},
                            '{{ auth()->user()->id == $booking->client_id ? 'client' : 'childminder' }}', 
                            '{{ auth()->user()->id == $booking->client_id ? 'childminder' : 'client' }}'  <!-- Correct logic for receiver -->
                        )"
                        class="custom-button">
                            📩 Message
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No confirmed bookings.</p>
            @endforelse
        </div>

        <!-- Rejected Bookings -->
        <h3 class="font-semibold text-lg mt-4 border-b-2 pb-2 mb-4 text-blue-500">Rejected Bookings</h3>
        <div class="space-y-4">
        @forelse($bookings->where('status', 'Cancelled') as $booking)
                <div class="border p-4 rounded-lg">
                    <h3 class="text-lg font-medium">
                        Childminder ID: {{ $booking->childminder_id }} -  
                        {{ optional($booking->childminderprofile)->first_name ?? 'Unknown' }} 
                        {{ optional($booking->childminderprofile)->last_name ?? 'Childminder' }}
                    </h3>
                    <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>Notes:</strong> {{ $booking->notes ?? 'No notes provided' }}</p>
                    <span class="text-sm text-red-500">This booking was cancelled.</span>
                </div>
            @empty
                <p class="text-gray-500">No cancelled bookings.</p>
            @endforelse
        </div>
    @endif
</div>
