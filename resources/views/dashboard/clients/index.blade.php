<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('dashboard.clients.create') }}"
               class="btn-primary w-full sm:w-auto text-center">
                + Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- DESKTOP TABLE VIEW -->
            <div class="hidden sm:block overflow-x-auto bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <x-table class="min-w-full">
                    <x-slot name="head">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Phone</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Actions</th>
                        </tr>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($clients as $client)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $client->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $client->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $client->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                    <a href="{{ route('dashboard.clients.show', $client) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View</a>
                                    <a href="{{ route('dashboard.clients.edit', $client) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                                    <form action="{{ route('dashboard.clients.destroy', $client) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this client?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
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

            <!-- MOBILE CARD VIEW -->
            <div class="sm:hidden space-y-4">
                @forelse($clients as $client)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                        <div class="space-y-2">
                            <div>
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">{{ $client->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-300"><span class="font-medium">Email:</span> {{ $client->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-300"><span class="font-medium">Phone:</span> {{ $client->phone }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-4 border-t border-gray-200 dark:border-gray-700 pt-3">
                            <a href="{{ route('dashboard.clients.show', $client) }}" class="text-blue-600 dark:text-blue-400 text-sm font-medium hover:underline">View</a>
                            <a href="{{ route('dashboard.clients.edit', $client) }}" class="text-indigo-600 dark:text-indigo-400 text-sm font-medium hover:underline">Edit</a>
                            <form action="{{ route('dashboard.clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Delete this client?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 text-sm font-medium hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400">No clients found.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
