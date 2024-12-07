<nav id="navbar" x-data="{ open: false }"
    class="fixed top-0 z-50 w-full p-4 font-sans antialiased bg-gradient-to-r from-slate-900 to-slate-950"
    style="font-family: 'Oswald', sans-serif; text-transform: uppercase;">
    <!-- Primary Navigation Menu -->
    <div class="flex items-center justify-between h-16 mx-auto max-w-7xl">
        <!-- Navigation Links -->
        <div class="hidden space-x-10 sm:flex">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-gray-300">
                {{ __('Events') }}
            </x-nav-link>
            <x-nav-link :href="route('fighter')" :active="request()->routeIs('fighter')" class="text-lg text-white hover:text-gray-300">
                {{ __('Fighters') }}
            </x-nav-link>
            <x-nav-link :href="route('history')" :active="request()->routeIs('history')" class="text-lg text-white hover:text-gray-300">
                {{ __('History') }}
            </x-nav-link>
        </div>

        <!-- Logo -->
        <div class="absolute transform -translate-x-1/2 left-1/2">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/boxing.png') }}" alt="Logo" class="w-auto h-16" />
            </a>
        </div>

        <!-- Settings Dropdown / Login Button -->
        <div class="hidden space-x-4 sm:flex sm:items-center">
            @auth
                <!-- Dropdown jika sudah login -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="focus:outline-none">
                            <div class="flex items-center">
                                <!-- Gambar atau inisial profil -->
                                <div class="flex items-center justify-center w-10 h-10 font-bold bg-gray-100 rounded-full text-slate-900"
                                    style="font-family: 'Oswald', sans-serif; text-transform: uppercase;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-lg text-gray-800">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="text-lg text-gray-800"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth

            @guest
                <!-- Button Login jika belum login -->
                <a href="{{ route('login') }}"
                    class="px-4 py-2 transition duration-300 ease-in-out bg-white border border-white text-slate-950 hover:bg-slate-950 hover:text-white">
                    {{ __('Login') }}
                </a>
            @endguest
        </div>


        <!-- Hamburger -->
        <div class="flex items-center sm:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="mt-5 sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-lg text-white">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('fighter')" :active="request()->routeIs('fighter')" class="text-lg text-white">
                {{ __('Fighter') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('history')" :active="request()->routeIs('history')" class="text-lg text-white">
                {{ __('History') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div x-data="{ open: false }" class="px-4">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full text-base font-medium text-gray-800 dark:text-gray-200 focus:outline-none"
                        style="font-family: 'Oswald', sans-serif; text-transform: uppercase;">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" class="mt-2 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')" class="text-sm">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')" class="text-sm"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @endauth

            <!-- Button Login jika belum login -->
            @guest
                <div>
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                </div>
            @endguest
        </div>
    </div>


</nav>
