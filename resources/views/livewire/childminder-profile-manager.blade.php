<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold">Childminder Profile</h2>

            @if (session()->has('message'))
                <div class="bg-green-200 p-2 text-green-800 rounded mt-4">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="saveProfile">
                <div class="grid grid-cols-1 gap-4 mt-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="first_name" wire:model="first_name" class="mt-1 p-2 block w-full border rounded-md">
                        @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="last_name" wire:model="last_name" class="mt-1 p-2 block w-full border rounded-md">
                        @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" id="city" wire:model="city" class="mt-1 p-2 block w-full border rounded-md">
                        @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="town" class="block text-sm font-medium text-gray-700">Town</label>
                        <input type="text" id="town" wire:model="town" class="mt-1 p-2 block w-full border rounded-md">
                        @error('town') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="hourly_rate" class="block text-sm font-medium text-gray-700">Hourly Rate (£)</label>
                        <input type="text" id="hourly_rate" wire:model="hourly_rate" class="mt-1 p-2 block w-full border rounded-md">
                        @error('hourly_rate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="about_me" class="block text-sm font-medium text-gray-700">About Me</label>
                        <textarea id="about_me" wire:model="about_me" class="mt-1 p-2 block w-full border rounded-md"></textarea>
                        @error('about_me') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                        <input type="text" id="postcode" wire:model="postcode" class="mt-1 p-2 block w-full border rounded-md">
                        @error('postcode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="service_scope_description" class="block text-sm font-medium text-gray-700">Service Scope Description</label>
                        <input type="text" id="service_scope_description" wire:model="service_scope_description" class="mt-1 p-2 block w-full border rounded-md">
                        @error('service_scope_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="geographical_area" class="block text-sm font-medium text-gray-700">Geographical Area</label>
                        <input type="text" id="geographical_area" wire:model="geographical_area" class="mt-1 p-2 block w-full border rounded-md">
                        @error('geographical_area') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="experience_years" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                        <input type="number" id="experience_years" wire:model="experience_years" class="mt-1 p-2 block w-full border rounded-md">
                        @error('experience_years') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
    <label for="age_groups" class="block text-sm font-medium text-gray-700">Age Groups</label>
    <select id="age_groups" wire:model="age_groups" multiple class="mt-1 p-2 block w-full border rounded-md">
        <option value="0-2">0-2</option>
        <option value="3-5">3-5</option>
        <option value="6-12">6-12</option>
        <option value="13-18">13-18</option>
    </select>
    @error('age_groups') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>


                    <div>
                        <label for="my_document" class="block text-sm font-medium text-gray-700">Documents</label>
                        <input type="file" id="my_document" wire:model="my_document" class="mt-1 p-2 block w-full border rounded-md" multiple>
                        @error('my_document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-blue p-2 rounded-md">Save Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
