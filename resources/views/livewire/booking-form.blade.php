
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>
<div class="mt-4 space-y-6">
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
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

        <!-- Services -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Select Services:</label>
            <div class="space-y-2">
                @foreach($services as $service)
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            wire:model="selected_services" 
                            value="{{ $service->id }}" 
                            id="service_{{ $service->id }}" 
                            class="h-4 w-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="service_{{ $service->id }}" class="ml-2 text-sm">{{ $service->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('selected_services') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Languages -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Select Languages:</label>
            <div class="space-y-2">
                @foreach($languages as $language)
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            wire:model="selected_languages" 
                            value="{{ $language->id }}" 
                            id="language_{{ $language->id }}" 
                            class="h-4 w-4 text-blue-500 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="language_{{ $language->id }}" class="ml-2 text-sm">{{ $language->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('selected_languages') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

    <!-- Notes -->
    <div class="mb-4">
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea wire:model="notes" id="notes" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

         <!-- Submit Button -->
         <div class="mt-4">
            <button type="submit" class="custom-button2">
                Create Booking
            </button>
        </div>
    </form>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 text-green-500">{{ session('message') }}</div>
    @endif
</div>
</div>