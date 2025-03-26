
<!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Childminder Profiles') }}
        </h2>
    </x-slot> -->
    <div class="mt-4 space-y-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <!-- Search Box -->
        <div class="mb-4">
            <label for="search" class="block text-sm font-medium text-gray-700">Search Profiles:</label>
            <input type="text" wire:model.debounce.300ms="searchTerm" id="search" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                   placeholder="Search by name, location, or service">
        </div>
        <!-- Filters Section -->
        @if ($showFilters)
            <div class="mb-4">
                <label for="filter_city" class="block text-sm font-medium text-gray-700">Select City:</label>
                <select wire:model="filter_city" id="filter_city" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Choose a city --</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>

                <label for="filter_town" class="block text-sm font-medium text-gray-700 mt-4">Select Town:</label>
                <select wire:model="filter_town" id="filter_town" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Choose a town --</option>
                    @foreach ($towns as $town)
                        <option value="{{ $town }}">{{ $town }}</option>
                    @endforeach
                </select>

                <label for="filter_service" class="block text-sm font-medium text-gray-700 mt-4">Preferred Service:</label>
                <select wire:model="filter_service" id="filter_service" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Choose a service --</option>
                    @foreach ($services as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <label for="filter_language" class="block text-sm font-medium text-gray-700 mt-4">Preferred Language:</label>
                <select wire:model="filter_language" id="filter_language" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Choose a language --</option>
                    @foreach ($languages as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <!-- Filter by Age Group -->
                <label for="filter_age_group" class="block text-sm font-medium text-gray-700">Preferred Age Group</label>
                <select wire:model="filter_age_group" id="filter_age_group" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Choose an Age Group --</option>
                    @foreach(['0-2', '3-5', '6-12', '13-18'] as $ageGroup)
                    <option value="{{ $ageGroup }}">{{ $ageGroup }}</option>
                    @endforeach
                </select>

                <!-- Search Button -->
                <div class="mt-4">
                    <button wire:click="searchProfiles" class="custom-button2">
                        Search
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Childminder Profiles Section -->
    <ul class="mt-4 space-y-6">


        @if ($viewMode === 'list')
            <!-- List of Childminder Profiles -->
            @if($profiles->isEmpty())
                <!-- No results found -->
                <div class="text-center col-span-full">
                    <p class="text-lg font-semibold text-gray-600">No results found. Please try other filters or keywords.</p>
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
                                <p class="text-sm text-gray-600">Hourly Rate: £{{ $profile->hourly_rate }}</p>
                            </div>
                            <!-- Inside the profile loop, after profile details -->
                            <div class="mt-4">
                            <button wire:click.prevent="goToBookingForm({{ $profile->id }}, '{{ $profile->first_name }} {{ $profile->last_name }}')" 
                             class="custom-button">
                            Book
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

                            <!-- Book Button -->
                            <!-- Inside the show profile view -->
                            <div class="mt-4 flex justify-center space-x-8">
                                <button wire:click.prevent="goToBookingForm({{ $currentProfile->id }}, '{{ $currentProfile->first_name }} {{ $currentProfile->last_name }}')"  
                                        class="custom-button">
                                    Book
                                </button>
    
                                <button wire:click.prevent="backToList" 
                                        class="custom-button2">
                                    Back to List
                                </button>
                                @php
                                    $client = Auth::check() ? \App\Models\ClientProfile::where('user_id', Auth::id())->first() : null;
                                    $clientPostcode = $client ? $client->postcode : null;
                                @endphp

                                <a href="{{ route('map.with-params', [
                                    'childminderId' => $currentProfile->id,
                                    'childminderName' => $currentProfile->first_name,
                                    'childminderPostcode' => $currentProfile->postcode,
                                    'clientPostcode' => $clientPostcode
                                ]) }}" class="custom-button3">
                                    View on Map
                                </a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endif
    </ul>
</div>
