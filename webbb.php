<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>Crystal CRM</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-xl font-semibold text-gray-800">
                            {{ $header }}
                        </h1>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 max-w-7xl mx-auto w-full py-8 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>

        <!-- Floating Dashboard Button -->
        @auth
            <a href="{{ route('dashboard') }}"
               class="fixed bottom-6 right-6 inline-flex items-center px-5 py-3 text-sm font-medium text-white bg-indigo-600 rounded-full shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                 Dashboard
            </a>
            <!-- Floating Welcome Button -->
<a href="{{ url('/') }}"
class="fixed bottom-6 left-6 inline-flex items-center px-5 py-3 text-sm font-medium text-indigo-600 bg-white border border-indigo-600 rounded-full shadow-lg hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
 ⬅️ Back to Home
</a>

        @endauth
    </body>
</html>


<!-- dashboard/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div x-data="{ open: false }" class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <!-- Page Title -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Overview') }}
            </h2>

            <!-- Desktop Nav -->
            <div class="hidden sm:flex flex-wrap gap-2">
                <a href="{{ route('dashboard.clients.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">Clients</a>
                <a href="{{ route('dashboard.cases.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">Cases</a>
                <a href="{{ route('dashboard.tasks.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">Tasks</a>
                <a href="{{ route('dashboard.documents.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">Documents</a>
                <a href="{{ route('dashboard.invoices.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">Invoices</a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.users.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">Users</a>
                @endif
            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden flex justify-end">
                <button @click="open = !open" class="p-2 rounded-md bg-gray-200 hover:bg-gray-300 focus:outline-none">
                    <!-- Icon: hamburger / close -->
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Dropdown -->
            <div x-show="open" class="sm:hidden mt-2 space-y-2 bg-white rounded shadow p-3">
                <a href="{{ route('dashboard.clients.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Clients</a>
                <a href="{{ route('dashboard.cases.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Cases</a>
                <a href="{{ route('dashboard.tasks.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Tasks</a>
                <a href="{{ route('dashboard.documents.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Documents</a>
                <a href="{{ route('dashboard.invoices.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Invoices</a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Users</a>
                @endif
            </div>
        </div>
    </x-slot>

    <!-- Stats Section -->
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Clients -->
            <a href="{{ route('dashboard.clients.index') }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Clients</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalClients }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </a>

            <!-- Users -->
            <a href="{{ route('dashboard.users.index') }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Users</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalUsers }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8.962 8.962 0 0112 15c2.21 0 4.21.8 5.879 2.136M15 11a4 4 0 11-8 0 4 4 0 018 0zM19.07 4.93a10 10 0 11-14.14 0" />
                </svg>
            </a>

            <!-- Pending Cases -->
            <a href="{{ route('dashboard.cases.index') }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Pending Cases</h3>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ $pendingCases }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 21h6l-.75-4m-6 0h6m-6 0L6.5 6h11L15.75 17m-9.25 0h12" />
                </svg>
            </a>

            <!-- Pending Invoices -->
            <a href="{{ route('dashboard.invoices.index') }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-700">Pending Invoices</h3>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingInvoices }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v10a2 2 0 01-2 2z" />
                </svg>
            </a>

        </div>
    </div>
</x-app-layout>


<!-- cases/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('dashboard.clients.create') }}" class="btn-primary">
                + Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-table>
                <x-slot name="head">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Phone
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="body">
                    @forelse($clients as $client)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $client->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $client->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $client->phone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                                <a href="{{ route('dashboard.clients.edit', $client) }}"
                                   class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('dashboard.clients.destroy', $client) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Delete this client?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 dark:text-red-400 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No clients found.
                            </td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>
        </div>
    </div>
</x-app-layout>


 <!-- navbar -->

 <nav x-data="{ open: false }" class="bg-white shadow fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-700">Crystal CRM</a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-6">
            <a href="{{ url('/') }}" 
               class="{{ request()->is('/') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Home
            </a>
            <a href="{{ route('features') }}" 
               class="{{ request()->routeIs('features') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Features
            </a>
            <a href="{{ route('whyus') }}" 
               class="{{ request()->routeIs('whyus') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Why Us
            </a>
            
            <a href="{{ route('contact.show') }}" 
               class="{{ request()->routeIs('contact.show') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Contact
            </a>
            <a href="{{ route('pricing') }}" 
   class="{{ request()->routeIs('pricing') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
   Pricing
</a>

        </div>

        <!-- Auth Buttons (Desktop) -->
        <div class="hidden md:flex space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" 
                   class="{{ request()->routeIs('dashboard') ? 'bg-indigo-700 text-white' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} px-4 py-2 rounded-lg">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   class="{{ request()->routeIs('login') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }} px-2">
                   Login
                </a>
                <a href="{{ route('register') }}" 
                   class="{{ request()->routeIs('register') ? 'bg-indigo-700 text-white' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} px-4 py-2 rounded-lg">
                   Register
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button @click="open = !open" class="text-gray-700 focus:outline-none">
                <span x-show="!open">☰</span>
                <span x-show="open">✖</span>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown -->
    <div x-show="open" x-transition class="md:hidden px-6 pb-4 space-y-2">
        <a href="{{ url('/') }}" 
           class="{{ request()->is('/') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
           Home
        </a>
        <a href="{{ route('features') }}" 
           class="{{ request()->routeIs('features') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
           Features
        </a>
        <a href="{{ route('whyus') }}" 
        class="{{ request()->routeIs('whyus') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
        Why Us
     </a>
        <a href="{{ route('contact.show') }}" 
           class="{{ request()->routeIs('contact.show') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
           Contact
        </a>
        <a href="{{ route('pricing') }}" 
   class="{{ request()->routeIs('pricing') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
   Pricing
</a>


        @auth
            <a href="{{ route('dashboard') }}" 
               class="{{ request()->routeIs('dashboard') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block text-gray-700 hover:text-indigo-700">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" 
               class="{{ request()->routeIs('login') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Login
            </a>
            <a href="{{ route('register') }}" 
               class="{{ request()->routeIs('register') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Register
            </a>
        @endauth
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>

</nav>

<!-- Spacer -->
<div class="h-20"></div>


<!-- app.blade -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Crystal CRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('crystalfavicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('crystalfavicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('crystalfavicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('crystalfavicon/site.webmanifest') }}">


    <!-- Scripts -->
    @if (app()->environment('production'))
    <link rel="stylesheet" href="{{ asset('build/assets/app-BOrthtGJ.css') }}">
    <script type="module" src="{{ asset('build/assets/app-Da_XqnL6.js') }}"></script>
@else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif

</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex flex-col">

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-1 max-w-7xl mx-auto w-full py-8 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>

   <!-- Floating Button Container -->
<div class="fixed bottom-6 left-0 w-full flex justify-between px-6 z-50" >
    @auth
        <!-- Back to Home -->
        <a href="{{ url('/') }}"
           class="inline-flex items-center px-5 py-3 text-sm font-medium text-indigo-600 bg-white border border-indigo-600 rounded-full shadow-lg hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition
                  dark:bg-gray-800 dark:text-gray-100 dark:border-indigo-400 dark:hover:bg-gray-700">
             ⬅️ Back to Home
        </a>

        <!-- Centered Theme Toggle -->
        <button id="theme-toggle"
            class="inline-flex items-center justify-center px-4 py-3 text-sm font-medium rounded-full bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 shadow-md transition">
            🌞 / 🌙
        </button>

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-5 py-3 text-sm font-medium text-white bg-indigo-600 rounded-full shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
             Dashboard
        </a>
    @endauth
</div>


    <!-- Global Styles for Forms, Buttons & Tables -->
    <style>
        /* Inputs */
        input, textarea, select {
            @apply w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500;
            @apply dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400;
        }

        /* Primary Button */
        .btn-primary {
            @apply px-4 py-2 rounded-md font-medium bg-indigo-600 text-white hover:bg-indigo-700
                   focus:outline-none focus:ring-2 focus:ring-indigo-500
                   dark:bg-indigo-500 dark:hover:bg-indigo-600;
        }

        /* Secondary Button */
        .btn-secondary {
            @apply px-4 py-2 rounded-md font-medium bg-gray-200 text-gray-800 hover:bg-gray-300
                   focus:outline-none focus:ring-2 focus:ring-indigo-500
                   dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600;
        }

        /* Tables */
        table {
            @apply min-w-full divide-y divide-gray-200 dark:divide-gray-700;
        }
        thead {
            @apply bg-gray-50 dark:bg-gray-800;
        }
        th {
            @apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300;
        }
        td {
            @apply px-6 py-4 text-sm text-gray-900 dark:text-gray-100;
        }
    </style>

    <!-- Dark/Light Mode Script -->
    <script>
        const html = document.documentElement;
        const themeToggle = document.getElementById("theme-toggle");

        // On page load -> set theme from localStorage
        if (localStorage.getItem("theme") === "dark") {
            html.classList.add("dark");
        }

        // Toggle theme
        function toggleTheme() {
            if (html.classList.contains("dark")) {
                html.classList.remove("dark");
                localStorage.setItem("theme", "light");
            } else {
                html.classList.add("dark");
                localStorage.setItem("theme", "dark");
            }
        }

        // Attach click event
        if (themeToggle) {
            themeToggle.addEventListener("click", toggleTheme);
        }
    </script>
</body>
</html>


 <!-- Floating Dashboard Button -->
 @auth
        <a href="{{ route('dashboard') }}"
           class="fixed bottom-6 right-6 inline-flex items-center px-5 py-3 text-sm font-medium text-white bg-indigo-600 rounded-full shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
             Dashboard
        </a>

        <!-- Floating Welcome Button -->
        <a href="{{ url('/') }}"
           class="fixed bottom-6 left-6 inline-flex items-center px-5 py-3 text-sm font-medium text-indigo-600 bg-white border border-indigo-600 rounded-full shadow-lg hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition
                  dark:bg-gray-800 dark:text-gray-100 dark:border-indigo-400 dark:hover:bg-gray-700">
             ⬅️ Back to Home
        </a>
    @endauth

    <!-- Dark/Light Mode Toggle Button -->
    <button id="theme-toggle"
        class="fixed bottom-20 right-6 px-4 py-2 rounded-full bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 shadow-md transition">
        🌞 / 🌙
    </button>