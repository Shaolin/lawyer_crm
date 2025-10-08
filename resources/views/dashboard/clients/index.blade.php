<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('dashboard.clients.create') }}" class="btn-primary w-full sm:w-auto text-center">
                + Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Desktop Table View --}}
            <div class="hidden sm:block bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-900 text-xs uppercase text-gray-500 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium">Name</th>
                                <th class="px-4 py-3 text-left font-medium">Email</th>
                                <th class="px-4 py-3 text-left font-medium">Phone</th>
                                <th class="px-4 py-3 text-right font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($clients as $client)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-gray-100">{{ $client->name }}</td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $client->email }}</td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $client->phone }}</td>
                                    <td class="px-4 py-3 text-right space-x-2">
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
                                    <td colspan="4" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                        No clients found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile Card View --}}
            <div class="sm:hidden space-y-4">
                @forelse($clients as $client)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 space-y-2">
                        <div class="flex justify-between">
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ $client->name }}</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Email:</strong> {{ $client->email }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Phone:</strong> {{ $client->phone }}</p>
                        <div class="flex justify-end space-x-3 pt-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('dashboard.clients.show', $client) }}" class="text-blue-600 dark:text-blue-400 text-sm font-medium hover:underline">View</a>
                            <a href="{{ route('dashboard.clients.edit', $client) }}" class="text-indigo-600 dark:text-indigo-400 text-sm font-medium hover:underline">Edit</a>
                            <form action="{{ route('dashboard.clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Delete this client?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 text-sm font-medium hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 dark:text-gray-400 py-4">
                        No clients found.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
