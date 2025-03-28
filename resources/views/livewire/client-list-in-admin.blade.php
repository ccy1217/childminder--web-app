<div class="mt-4 space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <!-- Search Box -->
        <div class="mb-4">
            <label for="search" class="block text-sm font-medium text-gray-700">Search Client Profiles:</label>
            <input type="text" wire:model.debounce.300ms="searchTerm" id="search" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                   placeholder="Search by name or client ID">
        </div>

        <!-- Search Button -->
        <div class="mt-4">
            <button wire:click="searchProfiles" class="custom-button2">
                Search
            </button>
        </div>
    </div>

    <!-- Client Profiles Section -->
    <ul class="mt-4 space-y-6">
        @if ($viewMode === 'list')
            <!-- List of Client Profiles -->
            @if($profiles->isEmpty())
                <!-- No results found -->
                <div class="text-center col-span-full">
                    <p class="text-lg font-semibold text-gray-600">No results found. Please try other keywords.</p>
                    <button wire:click="backToList" class="mt-4 bg-blue-500 text-black px-4 py-2 rounded-md hover:bg-blue-600">
                        Back to List
                    </button>
                </div>
            @else
                @foreach ($profiles as $profile)
                    <li wire:key="profile-{{ $profile->id }}" class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center space-x-6">
                            <!-- Profile Image (Left Side) -->
                            <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-blue-500 p-4 mr-6">
                                @if ($profile->profile_picture && file_exists(storage_path('app/public/' . $profile->profile_picture)) && is_readable(storage_path('app/public/' . $profile->profile_picture)))
                                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" class="object-cover w-full h-full" />
                                @else
                                    <div class="bg-gray-200 text-gray-500 flex items-center justify-center w-full h-full">No Image</div>
                                @endif
                            </div>

                            <!-- Profile Details (Right Side) -->
                            <div class="flex-grow">
                                <h4 class="text-lg font-semibold">
                                    <a href="#" wire:click.prevent="showProfile({{ $profile->id }})" class="text-blue-500 font-bold hover:underline">
                                        {{ $profile->first_name }} {{ $profile->last_name }}
                                    </a>
                                </h4>
                                <p class="text-sm text-gray-600">Location: {{ $profile->city }}, {{ $profile->town ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600">Child's Name: {{ $profile->children_name }}</p>
                            </div>

                            <!-- Delete Button -->
                            <div class="mt-4">
                                <button wire:click.prevent="deleteProfile({{ $profile->id }})" class="custom-button bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach

                <!-- Pagination Links -->
                <div class="mt-6 col-span-full">
                    {{ $profiles->links() }}
                </div>
            @endif
        @elseif ($viewMode === 'show')
            <!-- Profile Detail View -->
            <div class="py-12">
                <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-2xl font-bold text-blue-500">
                                {{ $currentProfile->first_name }} {{ $currentProfile->last_name }}
                            </h2>

                            <div class="mt-4 flex items-center justify-center">
                                @if ($currentProfile->profile_picture && file_exists(storage_path('app/public/' . $currentProfile->profile_picture)) && is_readable(storage_path('app/public/' . $currentProfile->profile_picture)))
                                    <img src="{{ asset('storage/' . $currentProfile->profile_picture) }}" alt="Profile Picture" class="object-cover w-32 h-32 rounded-full border-2 border-blue-500">
                                @else
                                    <div class="bg-gray-200 text-gray-500 flex items-center justify-center w-32 h-32 rounded-full border-2 border-blue-500">
                                        No Image
                                    </div>
                                @endif
                            </div>

                             <!-- Profile Details -->
                            <p class="text-sm text-gray-600 mt-2"><b>Client ID:</b> {{ $currentProfile->id }}</p>
                            <p class="text-sm text-gray-600 mt-2"><b>Child's Name:</b> {{ $currentProfile->children_name }}</p>
                            <p class="text-sm text-gray-600 mt-2"><b>Location:</b> {{ $currentProfile->city }}, {{ $currentProfile->town ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600 mt-2"><b>Postcode:</b> {{ $currentProfile->postcode ?? 'Not provided' }}</p>

                            <!-- Preferences and Requirements -->
                            <p class="mt-4"><b>Specific Requirements:</b> {{ $currentProfile->specific_requirements ?? 'Not provided' }}</p>

                            <!-- Preferred Age Groups -->
                            <p class="mt-2"><b>Preferred Age Groups:</b>
                                @php
                                    $ageGroups = is_string($currentProfile->preferred_age_groups) ? json_decode($currentProfile->preferred_age_groups, true) : $currentProfile->preferred_age_groups;
                                @endphp
                                {{ is_array($ageGroups) && !empty($ageGroups) ? implode(', ', $ageGroups) : 'Not specified' }}
                            </p>

                            <!-- Buttons (Delete and Back to List) -->
                            <div class="mt-6 flex justify-center space-x-4">
                                <!-- Delete Button -->
                                <button wire:click.prevent="deleteProfile({{ $currentProfile->id }})" class="custom-button bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">
                                    Delete
                                </button>

                                <!-- Back to List Button -->
                                <button wire:click.prevent="backToList" class="custom-button2">
                                    Back to List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </ul>
</div>
