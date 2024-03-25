<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('logo.png') }}" alt="Technometers">
                        <!--<x-application-logo class="block h-9 w-auto fill-current text-gray-800" />-->
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:items-center  sm:flex">
                    <!--<x-nav-link :href="route('locations.index')" :active="request()->routeIs('locations')">
                        {{ __('Location') }}
                    </x-nav-link>-->
                    <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Admin</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('locations.index')">
                            {{ __('Admin') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('locations.index')">
                                                {{ __('Admin Location') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('channels.index')">
                                                {{ __('Channel') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('day_months.index')">
                                                {{ __('Day Month') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('years.index')">
                                                {{ __('Year') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('load_limits.index')">
                                                {{ __('Load Limit') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('max_currents.index')">
                                                {{ __('Max Current') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('meter_locations.index')">
                                                {{ __('Meter Location') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('monthly_tariffs.index')">
                                                {{ __('Monthly Tariff ') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('monthly_whatts.index')">
                                                {{ __('Monthly Whatt') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('overload_delay_times.index')">
                                                {{ __('OverLoad Delay Time') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('tod_ones.index')">
                                                {{ __('TOD One') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('tod_twos.index')">
                                                {{ __('TOD Two') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('unbalance_currents.index')">
                                                {{ __('Unbalance Current') }}
                                            </x-dropdown-link>
                    
    
    

                        <x-dropdown-link :href="route('locations.index')">
                            {{ __('Location') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <x-dropdown-link :href="route('meters.index')">
                            {{ __('Meter') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                </div>

                <!--<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('logout')" :active="request()->routeIs('logout')">
                    {{ __('Log Out') }}
                    </x-nav-link>
                </div>-->

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
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('locations.index')" :active="request()->routeIs('locations.index')">
                {{ __('Location') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('channels.index')" :active="request()->routeIs('channels.index')">
            {{ __('Channel') }}
            </x-responsive-nav-link>

                     <!--  
                        <x-dropdown-link :href="route('day_months.index')">
                                                {{ __('Day Month') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('years.index')">
                                                {{ __('Year') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('load_limits.index')">
                                                {{ __('Load Limit') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('max_currents.index')">
                                                {{ __('Max Current') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('meter_locations.index')">
                                                {{ __('Meter Location') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('monthly_tariffs.index')">
                                                {{ __('Monthly Tariff ') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('monthly_whatts.index')">
                                                {{ __('Monthly Whatt') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('overload_delay_times.index')">
                                                {{ __('OverLoad Delay Time') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('tod_ones.index')">
                                                {{ __('TOD One') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('tod_twos.index')">
                                                {{ __('TOD Two') }}
                                            </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('unbalance_currents.index')">
                                                {{ __('Unbalance Current') }}
                                            </x-dropdown-link>
                    
    
    

                        <x-dropdown-link :href="route('locations.index')">
                            {{ __('Location') }}
                        </x-dropdown-link>

                       
                        <x-dropdown-link :href="route('meters.index')">
                            {{ __('Meter') }}
                        </x-dropdown-link>-->





        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
