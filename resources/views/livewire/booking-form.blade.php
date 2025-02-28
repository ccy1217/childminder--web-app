<div>
    <form wire:submit.prevent="submitBooking" class="space-y-4">
        <!-- Client ID is not shown because it's automatically set for the logged-in user -->
        
        <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Childminder Name:</label>
    <input type="text" value="{{ $childminder_name ?? 'N/A' }}" 
       class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>

</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Childminder ID:</label>
    <input type="text" value="{{ $childminder_id ?? 'Not Assigned' }}" 
       class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>

</div>


        <!-- Start Time -->
        <div class="mb-4">
            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
            <input wire:model="start_time" id="start_time" type="datetime-local" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- End Time -->
        <div class="mb-4">
            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
            <input wire:model="end_time" id="end_time" type="datetime-local" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('end_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Notes -->
        <div class="mb-4">
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea wire:model="notes" id="notes" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Create Booking
            </button>
        </div>
    </form>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 text-green-500">{{ session('message') }}</div>
    @endif
</div>
