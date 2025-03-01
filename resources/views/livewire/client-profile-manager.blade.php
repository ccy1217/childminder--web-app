<div class="mt-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold mb-4">Client Profile</h2>

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

                <!-- Children Names -->
                <div>
                    <label for="children_name" class="block text-sm font-medium text-gray-700">Children's Names</label>
                    <input type="text" id="children_name" wire:model="children_name" class="mt-1 p-2 block w-full border rounded-md">
                    @error('children_name')
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

                <!-- Postcode -->
                <div>
                    <label for="postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                    <input type="text" id="postcode" wire:model="postcode" class="mt-1 p-2 block w-full border rounded-md" placeholder="e.g., SM1 3LE">
                    @error('postcode')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Preferred Age Groups -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Preferred Age Groups</label>
                    <div class="space-y-2">
                        @foreach ($age_group_options as $key => $label)
                            <div class="flex items-center">
                                <input type="checkbox" id="age_group_{{ $key }}" wire:model="preferred_age_groups" value="{{ $key }}" class="h-5 w-5">
                                <label for="age_group_{{ $key }}" class="ml-2 text-sm">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('preferred_age_groups')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Specific Requirements -->
                <div>
                    <label for="specific_requirements" class="block text-sm font-medium text-gray-700">Specific Requirements</label>
                    <textarea id="specific_requirements" wire:model="specific_requirements" class="mt-1 p-2 block w-full border rounded-md"></textarea>
                    @error('specific_requirements')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-4 flex justify-center space-x-8">
                    <button type="submit" class="custom-button2">
                        Save Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
