<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Inventaris')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-inter bg-gray-50" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b border-gray-200">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <div class="-ml-2 mr-2 flex items-center md:hidden">
                            <button @click="sidebarOpen = true"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex-shrink-0 flex items-center">
                            <svg class="h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="ml-2 text-xl font-bold text-gray-900 hidden md:block">InventarisPro</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="relative ml-3">
                            @if (auth()->user()->avatar)
                            <div class="flex items-center space-x-2">
                                <div class="text-right hidden sm:block">
                                    <div class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">Administrator</div>
                                </div>
                                <img class="h-8 w-8 rounded-full"
                                    src="{{ asset('uploads/admin/' . Auth::user()->avatar) }}" alt="User profile">
                            </div>
                            @else
                            <div class="h-full w-full flex items-center justify-center text-gray-500 rounded-full">
                                <div class="text-right hidden sm:block">
                                    <div class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">Administrator</div>
                                </div>
                                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="md:hidden" x-show="sidebarOpen" style="display: none;">
            <div class="fixed inset-0 flex z-40">
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="sidebarOpen = false"></div>
                <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button @click="sidebarOpen = false"
                            class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:bg-gray-600">
                            <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <nav class="px-2 space-y-1">
                            <a href="{{ route('dashboard') }}"
                                class="{{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <i
                                    class="fas fa-tachometer-alt mr-3 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                                Dashboard
                            </a>

                            <a href="{{ route('items.index') }}"
                                class="{{ request()->routeIs('items.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <i
                                    class="fas fa-boxes mr-3 flex-shrink-0 {{ request()->routeIs('items.*') ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                                Barang
                            </a>

                            <a href="{{ route('categories.index') }}"
                                class="{{ request()->routeIs('categories.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <i
                                    class="fas fa-tags mr-3 flex-shrink-0 {{ request()->routeIs('categories.*') ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                                Kategori
                            </a>

                            <a href="{{ route('profile.index') }}"
                                class="{{ request()->routeIs('profile.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <i
                                    class="fas fa-user mr-3 flex-shrink-0 {{ request()->routeIs('profile.*') ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                                Profil Saya
                            </a>
                        </nav>
                    </div>
                    <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex-shrink-0 w-14" aria-hidden="true"></div>
            </div>
        </div>

        <div class="flex flex-1">
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <nav class="flex-1 px-2 space-y-1">
                            <a href="{{ route('dashboard') }}"
                                class="{{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <i
                                    class="fas fa-tachometer-alt mr-3 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                                Dashboard
                            </a>

                            <a href="{{ route('items.index') }}"
                                class="{{ request()->routeIs('items.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <i
                                    class="fas fa-boxes mr-3 flex-shrink-0 {{ request()->routeIs('items.*') ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                                Barang
                            </a>

                            <a href="{{ route('categories.index') }}"
                                class="{{ request()->routeIs('categories.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <i
                                    class="fas fa-tags mr-3 flex-shrink-0 {{ request()->routeIs('categories.*') ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                                Kategori
                            </a>

                            <a href="{{ route('profile.index') }}"
                                class="{{ request()->routeIs('profile.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <i
                                    class="fas fa-user mr-3 flex-shrink-0 {{ request()->routeIs('profile.*') ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
                                Profil Saya
                            </a>
                        </nav>
                    </div>
                    <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-auto">
                <div class="p-6">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
