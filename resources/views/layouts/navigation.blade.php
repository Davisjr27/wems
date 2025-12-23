{{-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
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
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
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
</nav> --}}

<!-- Sidebar Wrapper -->
<div x-data="{ open: false }" class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-50 inset-y-0 left-0 w-64 bg-white border-r shadow-xl transform transition duration-300 sm:translate-x-0 rounded-r-2xl">

        <!-- Sidebar Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-8 rounded-tr-2xl">
            <div class="flex items-center gap-3">
                <div>
                    <x-application-logo class="h-8 w-auto text-white" />
                </div>
                <div>
                    {{-- <h1 class="text-lg font-semibold tracking-wide">WEMS</h1> --}}
                    <span class="text-xs text-white/80">Student Portal</span>
                </div>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-6 px-4 space-y-2">

            <!-- Home -->
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium
        hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-sm transition
        {{ request()->routeIs('welcome') ? 'bg-indigo-100 text-indigo-700 shadow-sm' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l9.5-9.5 9.5 9.5M4.5 10.5v9.75A1.75 1.75 0 006.25 22h11.5A1.75 1.75 0 0019.5 20.25V10.5" />
                </svg>
                Home
            </a>

            <!-- Dashboard -->

            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium
                    hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-sm transition
                    {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 text-indigo-700 shadow-sm' : '' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3.75h6.5v6.5h-6.5zM13.75 3.75h6.5v6.5h-6.5zM3.75 13.75h6.5v6.5h-6.5zM13.75 13.75h6.5v6.5h-6.5z" />
                    </svg>
                    Dashboard
                </a>
            @elseif (Auth::user()->role === 'officer')
                <a href="{{ route('officer.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium
                    hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-sm transition
                    {{ request()->routeIs('officer.dashboard') ? 'bg-indigo-100 text-indigo-700 shadow-sm' : '' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3.75h6.5v6.5h-6.5zM13.75 3.75h6.5v6.5h-6.5zM3.75 13.75h6.5v6.5h-6.5zM13.75 13.75h6.5v6.5h-6.5z" />
                    </svg>
                    Dashboard
                </a>

                {{-- // profile link for officer --}}
                <a href="{{ route('officer.profile') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium
                         hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-sm transition">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Profile
                    </a>
            @else
                    <a href="{{ route('student.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium
                        hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-sm transition
                        {{ request()->routeIs('student.dashboard') ? 'bg-indigo-100 text-indigo-700 shadow-sm' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3.75h6.5v6.5h-6.5zM13.75 3.75h6.5v6.5h-6.5zM3.75 13.75h6.5v6.5h-6.5zM13.75 13.75h6.5v6.5h-6.5z" />
                        </svg>


                        Dashboard
                    </a>


                    <!-- Profile -->
                    <a href="{{ route('student.profile') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium
        hover:bg-indigo-50 hover:text-indigo-700 hover:shadow-sm transition">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Profile
                    </a>
            @endif

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 font-medium
            hover:bg-red-50 hover:text-red-700 hover:shadow-sm transition">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0V7a2 2 0 114 0v1" />
                            </svg>
                            Log Out
                        </button>
                    </form>

        </nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 sm:ml-64">

        <!-- Top Bar -->
        <header class="bg-white h-16 border-b flex items-center justify-between px-4 sm:px-6 shadow-sm">

            <!-- Mobile Button -->
            <button @click="open = !open"
                class="sm:hidden text-gray-700 hover:text-indigo-600 p-2 rounded-lg hover:bg-gray-100 shadow transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />

                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Top Bar Right -->
            <div class="hidden sm:flex items-center gap-3 text-gray-700 font-medium">
                <div class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">
                    {{ Auth::user()->name }}
                </div>
            </div>

        </header>

        <main class="p-6">
            {{-- {{ $slot ?? '' }} --}}
            @yield('content')
        </main>
    </div>

</div>
