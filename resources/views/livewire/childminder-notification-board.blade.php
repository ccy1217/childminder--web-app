<div class="p-4">
    @if ($pendingBookings->isEmpty() && $confirmedBookings->isEmpty() && $cancelledBookings->isEmpty())
        <p>No bookings available.</p>
    @else
        <!-- Booking Request Section with Underlined Text -->
        <h2 class="font-semibold text-2xl mb-6 underline">Booking Requests</h2>

        <!-- Pending Bookings -->
        <h3 class="font-semibold text-lg mt-6 border-b-2 pb-2 mb-4 text-blue-500">Pending Bookings</h3>
        <div class="space-y-4">
            @foreach($pendingBookings as $booking)
                <div class="border p-4 rounded-lg">
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
                            <button wire:click="acceptBooking({{ $booking->id }})" class="custom-button">
                                Accept
                            </button>
                            <button wire:click="rejectBooking({{ $booking->id }})" class="custom-button">
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

        <!-- Confirmed Bookings Table -->
        <h3 class="font-semibold text-lg mt-6 border-b-2 pb-2 mb-4 text-blue-500">Confirmed Bookings</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Client ID</th>
                        <th class="border px-4 py-2">Client Name</th>
                        <th class="border px-4 py-2">Start Time</th>
                        <th class="border px-4 py-2">End Time</th>
                        <th class="border px-4 py-2">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($confirmedBookings as $booking)
                        <tr>
                            <td class="border px-4 py-2">{{ $booking->client_id }}</td>
                            <td class="border px-4 py-2">
                                {{ optional($booking->clientprofile)->first_name ?? 'Unknown' }} 
                                {{ optional($booking->clientprofile)->last_name ?? 'Client' }}
                            </td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</td>
                            <td class="border px-4 py-2">{{ $booking->notes ?? 'No notes provided' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Cancelled Bookings Table -->
        <h3 class="font-semibold text-lg mt-6 border-b-2 pb-2 mb-4 text-blue-500">Cancelled Bookings</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Client ID</th>
                        <th class="border px-4 py-2">Client Name</th>
                        <th class="border px-4 py-2">Start Time</th>
                        <th class="border px-4 py-2">End Time</th>
                        <th class="border px-4 py-2">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cancelledBookings as $booking)
                        <tr>
                            <td class="border px-4 py-2">{{ $booking->client_id }}</td>
                            <td class="border px-4 py-2">
                                {{ optional($booking->clientprofile)->first_name ?? 'Unknown' }} 
                                {{ optional($booking->clientprofile)->last_name ?? 'Client' }}
                            </td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y, g:i a') }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($booking->end_time)->format('F j, Y, g:i a') }}</td>
                            <td class="border px-4 py-2">{{ $booking->notes ?? 'No notes provided' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mt-4 text-green-500">{{ session('message') }}</div>
    @endif
</div>
