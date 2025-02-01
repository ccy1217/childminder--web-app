<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold mb-4">Childminder Profile</h2>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Profile Form -->
            <form wire:submit.prevent="saveProfile" class="grid grid-cols-1 gap-6 mt-6">
                <!-- Profile Picture -->
                <div>
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input type="file" id="profile_picture" wire:model="profile_picture" accept="image/*" class="mt-1 block w-full">
                </div>

                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="first_name" wire:model="first_name" class="mt-1 p-2 block w-full border rounded-md">
                    @error('first_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="last_name" wire:model="last_name" class="mt-1 p-2 block w-full border rounded-md">
                    @error('last_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Provider URN -->
                <div>
                    <label for="provider_urn" class="block text-sm font-medium text-gray-700">Provider URN</label>
                    <input type="text" id="provider_urn" wire:model="provider_urn" class="mt-1 p-2 block w-full border rounded-md" placeholder="e.g., 398776 or EY222222">
                    @error('provider_urn')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="city" wire:model="city" class="mt-1 p-2 block w-full border rounded-md">
                    @error('city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Town -->
                <div>
                    <label for="town" class="block text-sm font-medium text-gray-700">Town</label>
                    <input type="text" id="town" wire:model="town" class="mt-1 p-2 block w-full border rounded-md">
                    @error('town')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Hourly Rate -->
                <div>
                    <label for="hourly_rate" class="block text-sm font-medium text-gray-700">Hourly Rate (£)</label>
                    <input type="number" id="hourly_rate" wire:model="hourly_rate" class="mt-1 p-2 block w-full border rounded-md">
                    @error('hourly_rate')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- About Me -->
                <div>
                    <label for="about_me" class="block text-sm font-medium text-gray-700">About Me</label>
                    <textarea id="about_me" wire:model="about_me" class="mt-1 p-2 block w-full border rounded-md"></textarea>
                    @error('about_me')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Postcode -->
                <div>
                    <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                    <input type="text" id="postcode" wire:model="postcode" class="mt-1 p-2 block w-full border rounded-md">
                    @error('postcode')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Language Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Languages</label>
                    <div class="space-y-2">
                        @foreach ($language_options as $key => $label)
                            <div class="flex items-center">
                                <input type="checkbox" id="language_{{ $key }}" wire:model="language_scope" value="{{ $key }}" class="h-5 w-5">
                                <label for="language_{{ $key }}" class="ml-2 text-sm">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('language_scope')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>



                
                <!-- Service Scope -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Service Scope</label>
                    <div class="space-y-2">
                        @foreach ($service_scope_options as $key => $label)
                            <div class="flex items-center">
                                <input type="checkbox" id="service_scope_{{ $key }}" wire:model="service_scope" value="{{ $key }}" class="h-5 w-5">
                                <label for="service_scope_{{ $key }}" class="ml-2 text-sm">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('service_scope')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Geographical Area -->
                <div>
                    <label for="geographical_area" class="block text-sm font-medium text-gray-700">Geographical Area</label>
                    <input type="text" id="geographical_area" wire:model="geographical_area" class="mt-1 p-2 block w-full border rounded-md">
                    @error('geographical_area')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Experience Years -->
                <div>
                    <label for="experience_years" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                    <input type="number" id="experience_years" wire:model="experience_years" class="mt-1 p-2 block w-full border rounded-md">
                    @error('experience_years')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Age Groups -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Age Groups</label>
                    <div class="space-y-4">
                        @foreach ($age_group_fields as $index => $ageGroup)
                            <div class="flex items-center space-x-4">
                                <select wire:model="age_group_fields.{{ $index }}" class="mt-1 p-2 block w-full border rounded-md">
                                    <option value="" disabled>Select Age Group</option>
                                    <option value="0-2">0-2</option>
                                    <option value="3-5">3-5</option>
                                    <option value="6-12">6-12</option>
                                    <option value="13-18">13-18</option>
                                </select>
                                <button type="button" wire:click="removeAgeGroupField({{ $index }})" class="text-red-500 hover:underline">Remove</button>
                            </div>
                            @error("age_group_fields.{$index}")
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        @endforeach
                    </div>
                    <button type="button" wire:click="addAgeGroupField" class="text-blue-500 hover:underline">Add Age Group</button>
                </div>

                <!-- Documents -->
                <div>
                    <label for="my_document" class="block text-sm font-medium text-gray-700">Documents</label>
                    <input type="file" id="my_document" wire:model="my_document" multiple class="mt-1 block w-full">
                    <ul class="mt-2">
                        @if ($my_document)
                            @foreach ($my_document as $doc)
                                <li>{{ is_object($doc) ? $doc->getClientOriginalName() : basename($doc) }}</li>
                            @endforeach
                        @endif
                    </ul>
                    @error('my_document.*')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="mt-1 block w-full font-bold py-3 rounded-md border-2 border-blue-500 shadow-lg hover:bg-blue-500 hover:text-white hover:shadow-xl transition-all duration-200" style="background-color: #6B8E23; color: white;">
                        Save Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
