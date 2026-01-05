<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Arsip Perpustakaan') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex md:flex-col shadow-sm">

            <div class="flex items-center justify-center h-16 border-b border-gray-200 px-4 bg-blue-600">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-white font-bold text-xl">
                    {{-- Ikon Buku --}}
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span>SIPUSTAKA</span>
                </a>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-2 overflow-y-auto">

                {{-- GROUP: UTAMA --}}
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-2">Utama</div>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-all group {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>

                {{-- GROUP: MANAJEMEN BUKU (Semua Role Bisa Akses) --}}
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2 ml-2">Manajemen Buku</div>

                {{-- Menu: Input Buku Baru --}}
                <a href="{{ route('books.create') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-all group {{ request()->routeIs('books.create') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('books.create') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Input Buku Baru
                </a>

                {{-- Menu: Data Buku --}}
                <a href="{{ route('books.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-all group {{ request()->routeIs('books.index') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('books.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Data Buku
                </a>

                {{-- Menu: Kategori (Sementara link pagar # dulu) --}}
                <a href="{{ route('categories.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-all group text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Kategori Buku
                </a>

                <a href="{{ route('shelves.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-all group text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Rak Buku
                </a>

                {{-- DROPDOWN LAPORAN --}}
                <div class="hidden sm:flex sm:items-center sm:ml-6 pt-1">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out {{ request()->routeIs('reports.*') ? 'border-indigo-500 text-gray-900' : '' }}">
                                <div>Laporan</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('reports.buku_induk')">1. Buku Induk</x-dropdown-link>
                            <x-dropdown-link :href="route('reports.pengadaan')">2. Pengadaan Baru</x-dropdown-link>
                            <x-dropdown-link :href="route('reports.klasifikasi')">3. Rekap Klasifikasi</x-dropdown-link>
                            <x-dropdown-link :href="route('reports.penghapusan')">4. Berita Acara Hapus</x-dropdown-link>
                            <x-dropdown-link :href="route('reports.stock_opname')">5. Stock Opname Rak</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                {{-- GROUP: ADMIN AREA (Hanya Muncul Jika Role Admin) --}}
                @if(Auth::user()->role === 'admin')
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2 ml-2">Admin Area</div>

                <a href="{{ route('users.index') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-all group {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Manajemen User
                </a>
                @endif

                {{-- GROUP: AKUN --}}
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2 ml-2">Akun</div>

                <a href="{{ route('profile.edit') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-all group {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('profile.edit') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil Saya
                </a>

            </nav>

            <div class="border-t border-gray-200 p-4 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700 truncate w-24">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role ?? 'karyawan' }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-1 rounded-md hover:bg-red-50" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- HEADER HALAMAN (Opsional) --}}
            @isset($header)
            <header class="bg-white shadow z-10 border-b">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <div class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $header }}
                    </div>
                </div>
            </header>
            @endisset

            {{-- SLOT HALAMAN --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-1">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>

</html>