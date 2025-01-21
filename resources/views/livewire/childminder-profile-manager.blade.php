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
                    
                    <!-- Display Preview if File is Uploaded -->
                    @if ($profile_picture && is_object($profile_picture))
                        <img src="{{ $profile_picture->temporaryUrl() }}" alt="Preview" class="mt-2 w-20 h-20 object-cover rounded">
                    @elseif ($profile && $profile->profile_picture)
                        <img src="{{ asset('storage/' . $profile->profile_pictures) }}" alt="Current Profile" class="mt-2 w-20 h-20 object-cover rounded">
                    @endif
                    
                    @error('profile_picture') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
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

                <!-- Service Scope Description -->
                <div>
                    <label for="service_scope_description" class="block text-sm font-medium text-gray-700">Service Scope Description</label>
                    <textarea id="service_scope_description" wire:model="service_scope_description" class="mt-1 p-2 block w-full border rounded-md"></textarea>
                    @error('service_scope_description') 
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

                <!-- Experience -->
                <div>
                    <label for="experience_years" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                    <input type="number" id="experience_years" wire:model="experience_years" class="mt-1 p-2 block w-full border rounded-md">
                    @error('experience_years') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Age Groups -->
                <div>
                    <label for="age_groups" class="block text-sm font-medium text-gray-700">Age Groups</label>
                    <select id="age_groups" wire:model="age_groups" multiple class="mt-1 p-2 block w-full border rounded-md">
                        <option value="0-2">0-2</option>
                        <option value="3-5">3-5</option>
                        <option value="6-12">6-12</option>
                        <option value="13-18">13-18</option>
                    </select>
                    @error('age_groups') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Documents -->
                <div>
                    <label for="my_document" class="block text-sm font-medium text-gray-700">Documents</label>
                    <input type="file" id="my_document" wire:model="my_document" multiple class="mt-1 block w-full">
                    
                    <!-- Display Document Names -->
                    @if ($my_document)
                        <ul class="mt-2">
                            @foreach ($my_document as $document)
                                @if (is_object($document))
                                    <li>{{ $document->getClientOriginalName() }}</li> <!-- Display original name if file object -->
                                @elseif (is_string($document)) 
                                    <li>{{ basename($document) }}</li> <!-- Display file name from path if stored -->
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    
                    @error('my_document.*') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
