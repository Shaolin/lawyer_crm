<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('dashboard.clients.create') }}" class="btn-primary">
                + Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Desktop Table -->
            <div class="hidden sm:block overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Name
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Email
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Phone
                            </th>
                            <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($clients as $client)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $client->name }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $client->email }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $client->phone }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium space-x-2 text-right">
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
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No clients found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Stacked Cards -->
            <div class="sm:hidden mt-4 space-y-2">
                @forelse($clients as $client)
                    <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-4">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $client->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-300">Email: {{ $client->email }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-300">Phone: {{ $client->phone }}</p>
                        <div class="flex flex-col space-y-1 mt-2">
                            <a href="{{ route('dashboard.clients.show', $client) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">View</a>
                            <a href="{{ route('dashboard.clients.edit', $client) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">Edit</a>
                            <form action="{{ route('dashboard.clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Delete this client?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm text-left">Delete</button>
                            </form>
                        </div>
                    </div>
                    <!-- Horizontal line between cards -->
                    <hr class="border-gray-200 dark:border-gray-700">
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400">No clients found.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
