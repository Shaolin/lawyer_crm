<x-app-layout>
    <x-slot name="header">
        <div x-data="{ open: false }" class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <!-- Page Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Dashboard Overview') }}
            </h2>

            <!-- Desktop Nav -->
            <div class="hidden sm:flex flex-wrap gap-2">
                <a href="{{ route('dashboard.clients.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">Clients</a>
                <a href="{{ route('dashboard.cases.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">Cases</a>
                <a href="{{ route('dashboard.tasks.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">Tasks</a>
                <a href="{{ route('dashboard.documents.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">Documents</a>
                <a href="{{ route('dashboard.invoices.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">Invoices</a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.users.index') }}" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-100">Users</a>
                @endif
            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden flex justify-end">
                <button @click="open = !open" class="p-2 rounded-md bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-100 focus:outline-none">
                    <!-- Icon: hamburger / close -->
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Slide-in Menu (keeps the same links and classes) -->
            <!-- overlay -->
            <div
                x-show="open"
                x-transition.opacity
                @click="open = false"
                class="fixed inset-0 bg-black bg-opacity-40 z-40 sm:hidden"
                aria-hidden="true"
            ></div>

            <!-- panel -->
            <aside
                x-show="open"
                x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                @keydown.escape.window="open = false"
                class="fixed inset-y-0 left-0 w-72 bg-white dark:bg-gray-800 rounded-r-md shadow-lg p-4 space-y-2 z-50 sm:hidden"
            >
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Menu</h3>
                    <button @click="open = false" class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <a href="{{ route('dashboard.clients.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-100">Clients</a>
                <a href="{{ route('dashboard.cases.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-100">Cases</a>
                <a href="{{ route('dashboard.tasks.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-100">Tasks</a>
                <a href="{{ route('dashboard.documents.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-100">Documents</a>
                <a href="{{ route('dashboard.invoices.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-100">Invoices</a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-100">Users</a>
                @endif
            </aside>
        </div>
    </x-slot>

    <!-- Stats Section -->
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Clients -->
            <a href="{{ route('dashboard.clients.index') }}"
               class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition flex items-center justify-between w-full">
                <div>
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200">Clients</h3>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $totalClients }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </a>

            <!-- Users -->
            <a href="{{ route('dashboard.users.index') }}"
               class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition flex items-center justify-between w-full">
                <div>
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200">Users</h3>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $totalUsers }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8.962 8.962 0 0112 15c2.21 0 4.21.8 5.879 2.136M15 11a4 4 0 11-8 0 4 4 0 018 0zM19.07 4.93a10 10 0 11-14.14 0" />
                </svg>
            </a>

            <!-- Pending Cases -->
            <a href="{{ route('dashboard.cases.index') }}"
               class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition flex items-center justify-between w-full">
                <div>
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200">Pending Cases</h3>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-2">{{ $pendingCases }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 21h6l-.75-4m-6 0h6m-6 0L6.5 6h11L15.75 17m-9.25 0h12" />
                </svg>
            </a>

            <!-- Pending Invoices -->
            <a href="{{ route('dashboard.invoices.index') }}"
               class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 hover:shadow-lg transition flex items-center justify-between w-full">
                <div>
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200">Pending Invoices</h3>
                    <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mt-2">{{ $pendingInvoices }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v10a2 2 0 01-2 2z" />
                </svg>
            </a>

        </div>
    </div>
</x-app-layout>
