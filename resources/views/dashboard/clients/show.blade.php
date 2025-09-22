<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Client Details') }}
            </h2>
            <a href="{{ route('dashboard.clients.index') }}" class="btn-secondary">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <!-- Client Info -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ $client->name }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Registered on {{ $client->created_at->format('M d, Y') }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Email</h4>
                            <p class="text-gray-900 dark:text-gray-100">{{ $client->email ?? '—' }}</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Phone</h4>
                            <p class="text-gray-900 dark:text-gray-100">{{ $client->phone ?? '—' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Address</h4>
                            <p class="text-gray-900 dark:text-gray-100">{{ $client->address ?? '—' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Notes</h4>
                            <p class="text-gray-900 dark:text-gray-100">{{ $client->notes ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('dashboard.clients.edit', $client) }}" class="btn-primary">
                        Edit Client
                    </a>

                    <form action="{{ route('dashboard.clients.destroy', $client) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this client?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
