<div class="p-4">
    @if ($bookings->isEmpty())
        <p>No pending bookings.</p>
    @else
        <div class="space-y-4">
            @foreach($bookings as $booking)
                <div class="border p-4 rounded-lg">
                    <!-- Display client_id, first_name, and last_name -->
                    <h3 class="text-lg font-medium">
                        Client ID: {{ $booking->client_id }} - 
                        {{ optional($booking->clientprofile)->first_name ?? 'Unknown' }} 
                        {{ optional($booking->clientprofile)->last_name ?? 'Client' }}

                    </h3>
                    <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</p>

                    <p><strong>Notes:</strong> {{ $booking->notes ?? 'No notes provided' }}</p>

                    <div class="mt-4">
                        @if ($booking->status == 'Pending')
                            <button wire:click="acceptBooking({{ $booking->id }})" 
                                    class="custom-button">
                                Accept
                            </button>
                            <button wire:click="rejectBooking({{ $booking->id }})" 
                                    class="custom-button">
                                Reject
                            </button>
                        @else
                            <span class="text-sm text-gray-500 mt-2">
                                This request has already been processed.
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mt-4 text-green-500">{{ session('message') }}</div>
    @endif
</div>
