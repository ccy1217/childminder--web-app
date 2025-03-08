<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Display Notification Board for Childminders -->
                    @if (Auth::check() && Auth::user()->childminderProfile) <!-- Directly checking for childminderProfile -->
                    <div class="mt-2">
                        <h1 class="text-lg font-bold mb-4">My Schedule:</h1>
                        @livewire('childminder-timetable', ['childminderId' => auth()->user()->childminderProfile->id ?? null])
                    </div>

                        <!-- Include the Livewire Component for ChildminderNotificationBoard -->
                        @livewire('childminder-notification-board')
                    @endif
                    
                    <!-- Display Booking Action for Clients -->
                    @if (Auth::check() && Auth::user()->clientProfile) <!-- Checking for clientProfile -->
                        <!-- Include the Livewire Component for BookingActions -->
                        @livewire('booking-actions')
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
