<nav x-data="{ open: false }" style="background-color: #2D4059; border-bottom: 3px solid #F07B3F;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Brand -->
                <a href="{{ url('/') }}" class="text-base sm:text-lg font-extrabold tracking-wider uppercase border-l-4 border-[#F07B3F] pl-3 text-[#EEEEEE] shrink-0 me-6">
                    Fleet <span class="text-[#F07B3F]">Management</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 lg:-my-px lg:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                        {{ __('Pemesanan') }}
                    </x-nav-link>
                    @can('is-admin')
                    <x-nav-link :href="route('admin.vehicles.index')" :active="request()->routeIs('admin.vehicles.*')">
                        {{ __('Kendaraan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.drivers.index')" :active="request()->routeIs('admin.drivers.*')">
                        {{ __('Driver') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.locations.index')" :active="request()->routeIs('admin.locations.*')">
                        {{ __('Lokasi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.usages.index')" :active="request()->routeIs('admin.usages.*')">
                        {{ __('BBM (Konsumsi)') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                        {{ __('Jadwal Service') }}
                    </x-nav-link>
                    @endcan
                    <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                        {{ __('Laporan') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden lg:flex lg:items-center lg:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150" style="color: #EEEEEE; background: transparent;">
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
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out" style="color: #EEEEEE;">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden" style="background-color: #2D4059;">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">{{ __('Pemesanan') }}</x-responsive-nav-link>
            @can('is-admin')
            <x-responsive-nav-link :href="route('admin.vehicles.index')" :active="request()->routeIs('admin.vehicles.*')">{{ __('Kendaraan') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.drivers.index')" :active="request()->routeIs('admin.drivers.*')">{{ __('Driver') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.locations.index')" :active="request()->routeIs('admin.locations.*')">{{ __('Lokasi') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.usages.index')" :active="request()->routeIs('admin.usages.*')">{{ __('BBM (Konsumsi)') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">{{ __('Jadwal Service') }}</x-responsive-nav-link>
            @endcan
            <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">{{ __('Laporan') }}</x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1" style="border-top: 1px solid #F07B3F;">
            <div class="px-4">
                <div class="font-medium text-base" style="color: #EEEEEE;">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm" style="color: #4CAF50;">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
