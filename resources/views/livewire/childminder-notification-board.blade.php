<div class="p-4">
    @if ($pendingBookings->isEmpty() && $confirmedBookings->isEmpty() && $cancelledBookings->isEmpty())
        <p>No bookings available.</p>
    @else
        <!-- Booking Request Section -->
        <h2 class="font-semibold text-2xl mb-6 underline">Booking Requests</h2>

        <!-- Pending Bookings -->
        <h3 class="font-semibold text-lg mt-6 border-b-2 pb-2 mb-4 text-blue-500">Pending Bookings</h3>
        <div class="space-y-4">
            @forelse($pendingBookings as $booking)
                <div class="border p-4 rounded-lg">
                    <h3 class="text-lg font-medium">
                        Client: 
                        {{ optional($booking->clientprofile)->first_name ?? 'Unknown' }} 
                        {{ optional($booking->clientprofile)->last_name ?? 'Client' }}
                    </h3>
                    <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>End:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>Notes:</strong> {{ $booking->notes ?? 'No notes provided' }}</p>

                    <div class="mt-2">
                        @if ($booking->status == 'Pending')
                            <button wire:click="acceptBooking({{ $booking->id }})" class="px-4 py-1 bg-green-500 text-white rounded">
                                Accept
                            </button>
                            <button wire:click="rejectBooking({{ $booking->id }})" class="px-4 py-1 bg-red-500 text-white rounded">
                                Reject
                            </button>
                        @else
                            <span class="text-sm text-gray-500 mt-2">
                                This request has already been processed.
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No pending bookings.</p>
            @endforelse
        </div>

        <!-- Confirmed Bookings -->
        <h3 class="font-semibold text-lg mt-6 border-b-2 pb-2 mb-4 text-blue-500">Confirmed Bookings</h3>
        <div class="space-y-4">
            @forelse($confirmedBookings as $booking)
                <div class="border p-4 rounded-lg">
                    <h3 class="text-lg font-medium">
                        Client: 
                        {{ optional($booking->clientprofile)->first_name ?? 'Unknown' }} 
                        {{ optional($booking->clientprofile)->last_name ?? 'Client' }}
                    </h3>
                    <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>End:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>Notes:</strong> {{ $booking->notes ?? 'No notes provided' }}</p>
                    <span class="text-sm text-red-500">Booking confirmed.</span>
                </div>
            @empty
                <p class="text-gray-500">No confirmed bookings.</p>
            @endforelse
            <button wire:click="openMessageBoard(
    {{ auth()->user()->id }},
    {{ $booking->client_id }},
    '{{ $booking->clientprofile->first_name ?? 'Unknown' }}',
    '{{ $booking->clientprofile->last_name ?? 'Unknown' }}',
    {{ $booking->childminder_id }},
    {{ $booking->childminderprofile->user_id ?? 'null' }},
    '{{ $booking->childminderprofile->first_name ?? 'Unknown' }}',
    '{{ $booking->childminderprofile->last_name ?? 'Unknown' }}',
    {{ $booking->clientprofile->user_id ?? 'null' }},
    '{{ auth()->user()->id == $booking->client_id ? 'client' : 'childminder' }}',
    '{{ $booking->client_id == $booking->clientprofile->user_id ? 'client' : 'childminder' }}'
)"
class="bg-blue-500 text-white px-4 py-2 rounded mt-2 hover:bg-blue-600">
    Message
</button>


        </div>

        <!-- Cancelled Bookings -->
        <h3 class="font-semibold text-lg mt-6 border-b-2 pb-2 mb-4 text-blue-500">Cancelled Bookings</h3>
        <div class="space-y-4">
            @forelse($cancelledBookings as $booking)
                <div class="border p-4 rounded-lg">
                    <h3 class="text-lg font-medium">
                        Client: 
                        {{ optional($booking->clientprofile)->first_name ?? 'Unknown' }} 
                        {{ optional($booking->clientprofile)->last_name ?? 'Client' }}
                    </h3>
                    <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>End:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</p>
                    <p><strong>Notes:</strong> {{ $booking->notes ?? 'No notes provided' }}</p>
                    <span class="text-sm text-red-500">This booking was cancelled.</span>
                </div>
            @empty
                <p class="text-gray-500">No cancelled bookings.</p>
            @endforelse
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mt-4 text-gray-500">{{ session('message') }}</div>
    @endif
</div>
