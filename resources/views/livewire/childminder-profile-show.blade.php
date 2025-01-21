<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <ul class="mt-4 space-y-6 bg-grey p-6 rounded-lg shadow-sm">
        @if ($viewMode === 'list')
            <!-- List of Childminder Profiles -->
            @foreach ($profiles as $profile)
                <li class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-start border border-gray-200">
                    <!-- Left Section: Profile Image -->
                    <div class="relative w-full" style="max-width: 200px; margin-right: 1.5rem;">
                        <div class="aspect-ratio-box">
                            @if ($profile->profile_picture && file_exists(storage_path('app/public/' . $profile->profile_picture)) && is_readable(storage_path('app/public/' . $profile->profile_picture)))
                                <img src="{{ asset('storage/' . $profile->profile_picture) }}" class="object-cover w-full h-full rounded-full p-2" />
                            @else
                                <div class="bg-gray-200 text-gray-500 flex items-center justify-center w-full h-full rounded-full p-2">
                                    No Image
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Section: Profile Details -->
                    <div class="flex-grow p-8">
                        <h4 class="text-lg font-semibold">
                            <a href="#" wire:click="showProfile({{ $profile->id }})" class="text-blue-500 font-bold">
                                {{ $profile->first_name }} {{ $profile->last_name }}
                            </a>
                        </h4>
                        <p class="text-sm text-gray-600 mt-1">Location: {{ $profile->city }}, {{ $profile->town ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600 mt-1">Hourly Rate: £{{ $profile->hourly_rate }}</p>
                    </div>
                </li>
            @endforeach

            <!-- Pagination Links -->
            <div class="mt-6">
                {{ $profiles->links() }}
            </div>
        @elseif ($viewMode === 'show')
            <!-- Profile Detail View -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-2xl font-bold text-blue-500">
                                {{ $currentProfile->first_name }} {{ $currentProfile->last_name }}
                            </h2>
                            <p class="text-sm text-gray-600 mt-2">Location: {{ $currentProfile->city }}, {{ $currentProfile->town ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600 mt-2">Hourly Rate: £{{ $currentProfile->hourly_rate }}</p>
                            <p class="mt-4"><b>About Me:</b> {{ $currentProfile->about_me ?? 'Not provided' }}</p>
                            <p class="mt-2"><b>Postcode:</b> {{ $currentProfile->postcode ?? 'Not provided' }}</p>
                            <p class="mt-2"><b>Service Scope:</b> {{ $currentProfile->service_scope_description ?? 'Not provided' }}</p>
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

                            <button wire:click="backToList" class="mt-6 bg-gray-300 text-black px-4 py-2 rounded underline">
                                Back to List
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </ul>
</div>
