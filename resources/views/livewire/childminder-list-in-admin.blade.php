<div class="mt-4 space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <!-- Search Box -->
        <div class="mb-4">
            <label for="search" class="block text-sm font-medium text-gray-700">Search Profiles:</label>
            <input type="text" wire:model.debounce.300ms="searchTerm" id="search" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                placeholder="Search by name or childminder id">
        </div>
        <!-- Search Button -->
        <div class="mt-4">
            <button wire:click="searchProfiles" class="custom-button2">
                Search
            </button>
        </div>
    </div>
    <!-- Childminder Profiles Section -->
    <ul class="mt-4 space-y-6">
        @if ($viewMode === 'list')
            <!-- List of Childminder Profiles -->
            @if($profiles->isEmpty())
                <!-- No results found -->
                <div class="text-center col-span-full">
                    <p class="text-lg font-semibold text-black-600">No results found. Please try other keywords.</p>
                    <button wire:click="backToList" class="custom-button2">
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
                                <p class="text-sm text-gray-600">Hourly Rate: £{{ $profile->hourly_rate }}</p>
                            </div>

                            <!-- Delete Button -->
                            <div class="mt-4">
                            <button wire:click.prevent="deleteProfile({{ $profile->id }})" class="custom-button4">
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
                             <!-- Childminder ID -->
                            <p class="text-sm text-gray-600 mt-2"><b>Childminder ID:</b> {{ $currentProfile->id }}</p>
                            <p class="text-sm text-gray-600 mt-2">Location: {{ $currentProfile->city }}, {{ $currentProfile->town ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600 mt-2">Hourly Rate: £{{ $currentProfile->hourly_rate }}</p>
                            <p class="mt-4"><b>About Me:</b> {{ $currentProfile->about_me ?? 'Not provided' }}</p>
                            <p class="mt-2"><b>Postcode:</b> {{ $currentProfile->postcode ?? 'Not provided' }}</p>

                            <!-- Language Section -->
                            <p class="mt-2"><b>Languages:</b>
                                @if ($currentProfile->languages->isNotEmpty())
                                    @foreach ($currentProfile->languages as $language)
                                        <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-2 py-1 rounded-full mr-2 mt-2">
                                            {{ $language->name }}
                                        </span>
                                    @endforeach
                                @else
                                    Not specified
                                @endif
                            </p>

                            <p class="mt-2"><b>Service Scope:</b>
                               @if ($currentProfile->services->isNotEmpty())
                                    @foreach ($currentProfile->services as $service)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold px-2 py-1 rounded-full mr-2 mt-2">
                                            {{ $service->name }}
                                        </span>
                                    @endforeach
                               @else
                                   Not provided
                               @endif
                           </p>

                            <p class="mt-2"><b>Geographical Area:</b> {{ $currentProfile->geographical_area ?? 'Not provided' }}</p>
                            <p class="mt-2"><b>Experience (Years):</b> {{ $currentProfile->experience_years ?? 'Not specified' }}</p>

                            <p class="mt-2"><b>Age Groups:</b>
                                @php
                                    $ageGroups = is_string($currentProfile->age_groups) ? json_decode($currentProfile->age_groups, true) : $currentProfile->age_groups;
                                @endphp
                                {{ is_array($ageGroups) && !empty($ageGroups) ? implode(', ', $ageGroups) : 'Not specified' }}
                            </p>

                            <div class="mt-2">
                                <strong>Documents:</strong>
                                @php
                                    $documents = $currentProfile->my_document ? json_decode($currentProfile->my_document, true) : [];
                                @endphp
                                @if (is_array($documents) && !empty($documents))
                                    <ul>
                                        @foreach ($documents as $document)
                                            <li>
                                                <a href="{{ asset('storage/' . $document) }}" target="_blank" class="text-blue-500 hover:underline">{{ $document }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Not provided</p>
                                @endif
                            </div>

                            <!-- Include the ChildminderTimetable Component -->
                            <div class="mt-2">
                                <h2 class="text-lg font-semibold mb-4">Childminder Schedule:</h2>
                                @livewire('childminder-timetable', ['childminderId' => $currentProfile->id])
                            </div>
                            
                            <div class="mt-2">
                                <livewire:comment-show :childminderId="$currentProfile->id" />
                            </div>

                            <div class="mt-6 flex justify-center space-x-4">
                                <!-- Delete Button-->
                                <button wire:click.prevent="deleteProfile({{ $currentProfile->id }})" class="custom-button4">
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
