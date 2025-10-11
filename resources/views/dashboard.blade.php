<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Overview') }}
            </h2>

            <div class="flex space-x-2">
                <!-- Clients link -->
                <a href="{{ route('dashboard.clients.index') }}"
                   class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                    Clients
                </a>
                <!-- Projects link -->
                <a href="{{ route('dashboard.projects.index') }}"
                   class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                    Projects
                </a>

                <!-- Cases link -->
                <a href="{{ route('dashboard.cases.index') }}"
                   class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                    Cases
                </a>

                <!-- Tasks link -->
                <a href="{{ route('dashboard.tasks.index') }}"
                   class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                    Tasks
                </a>

                <!-- Documents link -->
                <a href="{{ route('dashboard.documents.index') }}"
                   class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                    Documents
                </a>

                <!-- Invoices link -->
                <a href="{{ route('dashboard.invoices.index') }}"
                   class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                    Invoices
                </a>

                <form method="GET" action="{{ route('pay') }}">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg">
                        Pay ₦5000 with Paystack
                    </button>
                </form>
                

                <!-- Users link (only visible to admin) -->
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.users.index') }}"
                       class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                        Users
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
