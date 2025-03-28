<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <!-- Important Notice at the Top -->
    <div style="background-color:rgba(245, 240, 182, 0.83) ;" class="text-black p-6 rounded-md shadow-md mx-6 mt-6">
    ⚠️⚠️ <strong>Important Notice:</strong> This platform facilitates the booking of childminder services but does not handle any financial transactions. Payments must be arranged directly between parents and childminders. Please ensure you discuss and agree on payment terms independently.
    </div>


    <div class="mt-4 p-6"> 
        <div class="max-w-7xl mx-auto sm:px-8 lg:px-10 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg "> 
                <p class="text-gray-900">
                    
                   <!-- Admin Panel (Visible Only to Admins) -->
                    @if(Auth::check() && Auth::user()->user_type === 'admin')
                        <div class="flex justify-between mb-6">
                            <a href="{{ route('client-list-in-admin') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
                                Manage Client Users
                            </a>
                            <a href="{{ route('childminder-list-in-admin') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md">
                                Manage Childminder Users
                            </a>
                        </div>
                    @endif

                    <!-- Display Notification Board for Childminders -->
                    @if (Auth::check() && Auth::user()->childminderProfile) 
                    
                    <div class="mt-4 mx-10 p-6">  <!-- Left padding for the whole section -->
                        <h1 class="text-lg font-bold mb-4 ">    My Schedule:</h1>
                        @livewire('childminder-timetable', ['childminderId' => auth()->user()->childminderProfile->id ?? null])
                    </div>

                    <div class="mt-6 mx-10">  <!-- Added Margin for Notification Board -->
                        @livewire('childminder-notification-board')
                    </div>

                    @endif
                    
                    <!-- Display Booking Action for Clients -->
                    @if (Auth::check() && Auth::user()->clientProfile)
                    <div class="mt-6 mx-10">  <!-- Added Margin for Booking Actions -->
                        @livewire('booking-actions')
                    </div>
                    @endif

            </div>
        </div>
    </div>
    
</x-app-layout>
