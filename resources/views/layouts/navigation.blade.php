<style>
.wavy-line {
    position: relative;
    width: 100%;
    height: 5px; /* Thickness of the wavy line */
    background: repeating-linear-gradient(
        -45deg,
        orange 0px, orangered 3px,
        transparent 3px, transparent 6px
    ); /* Creates a wavy effect */
    z-index: 1; /* Ensure the wave is below the dropdown */
}

nav {
    position: relative; /* Ensure the nav bar is relative so other elements inside can position accordingly */
}

</style>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Childminder Profile -->
                    @if(Auth::check() && Auth::user()->user_type === 'client')
                        <x-nav-link :href="route('childminder-profile-show-in-client')" 
                        :active="request()->routeIs('childminder-profile-show-in-client')">
                            {{ __('Find a childminder profile') }}
                        </x-nav-link>
                    @elseif(Auth::check() && Auth::user()->user_type === 'childminder')
                        <x-nav-link :href="route('childminder-profile-show')" 
                        :active="request()->routeIs('childminder-profile-show')">
                             {{ __('Childminder profiles') }}
                        </x-nav-link>
                    @endif

                </div>
            </div>

            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Account details') }}
                        </x-dropdown-link>
                        @if(Auth::check() && Auth::user()->user_type === 'childminder')
                            <x-dropdown-link :href="route('childminder-profile-manage')">
                                {{ __('Manage Childminder Profile') }}
                            </x-dropdown-link>
                        @elseif(Auth::check() && Auth::user()->user_type === 'client')
                            <x-dropdown-link :href="route('client-profile-manager')">
                                {{ __('Manage Client Profile') }}
                            </x-dropdown-link>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Add the wavy line at the bottom -->
    <div class="wavy-line"></div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if(Auth::check() && Auth::user()->user_type === 'client')
                <x-responsive-nav-link :href="route('childminder-profile-show-in-client')" 
                    :active="request()->routeIs('childminder-profile-show-in-client')">
                    {{ __('Childminder Profiles') }}
                </x-responsive-nav-link>
            @elseif(Auth::check() && Auth::user()->user_type === 'childminder')
                <x-responsive-nav-link :href="route('childminder-profile-show')" 
                    :active="request()->routeIs('childminder-profile-show')">
                    {{ __('Manage Your Profile') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Account details') }}
                </x-responsive-nav-link>
                @if(Auth::check() && Auth::user()->user_type === 'childminder')
                    <x-responsive-nav-link :href="route('childminder-profile-manage')">
                        {{ __('Manage Childminder Profile') }}
                    </x-responsive-nav-link>
                @elseif(Auth::check() && Auth::user()->user_type === 'client')
                    <x-responsive-nav-link :href="route('client-profile-manager')">
                        {{ __('Manage Client Profile') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
