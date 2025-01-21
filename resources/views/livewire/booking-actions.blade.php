<div>
    <h3>Booking Status: {{ $status }}</h3>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if ($status === 'Pending')
        <button wire:click="acceptBooking" class="btn btn-primary">Accept</button>
        <button wire:click="cancelBooking" class="btn btn-danger">Cancel</button>
    @elseif ($status === 'Confirmed')
        <p>The booking has been confirmed.</p>
    @elseif ($status === 'Cancelled')
        <p>The booking has been cancelled.</p>
    @else
        <p>Unknown status: {{ $status }}</p>
    @endif
</div>
