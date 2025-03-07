<div class="p-3">
    @if ($bookings->isEmpty())
        <p>No bookings available.</p>
    @else
        <h2 class="font-semibold text-2xl mb-6 underline">Your Booking History</h2>

        <!-- Pending Bookings -->
        <h3 class="font-semibold text-lg mt- border-b-2 pb-2 mb-4 text-blue-500">Pending Bookings</h3>
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
                <div class="border p-4 rounded-lg">
                    <h3 class="text-lg font-medium">
                        Childminder: 
                        {{ optional($booking->childminderprofile)->first_name ?? 'Unknown' }} 
                        {{ optional($booking->childminderprofile)->last_name ?? 'Childminder' }}
                    </h3>
                    <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>Notes:</strong> {{ $booking->notes ?? 'No notes provided' }}</p>
                    <span class="text-sm text-red-500">Booking confirmed.</span>
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
                        Childminder: 
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
        </div>
    @endif
</div>