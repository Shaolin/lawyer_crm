<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('dashboard.clients.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mobile Card View --}}
            <div class="sm:hidden space-y-4">
                @forelse($clients as $client)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg mb-2">
                            {{ $client->name }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Email:</span> {{ $client->email ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                            <span class="font-medium">Phone:</span> {{ $client->phone ?? 'N/A' }}
                        </p>

                        <div class="flex items-center justify-end gap-4 pt-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('dashboard.clients.show', $client) }}"
                               class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white text-sm">
                                View
                            </a>
                            <a href="{{ route('dashboard.clients.edit', $client) }}"
                               class="text-indigo-600 hover:text-indigo-900 text-sm">
                                Edit
                            </a>
                            <form action="{{ route('dashboard.clients.destroy', $client) }}" method="POST"
                                  onsubmit="return confirm('Delete this client?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600 text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400 mt-6">No clients found.</p>
                @endforelse
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden sm:block bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mt-4">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Phone</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase">Actions</th>
                        </tr>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($clients as $client)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $client->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                    {{ $client->email }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                    {{ $client->phone }}
                                </td>
                                <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                    <a href="{{ route('dashboard.clients.show', $client) }}"
                                       class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                                        View
                                    </a>
                                    <a href="{{ route('dashboard.clients.edit', $client) }}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </a>
                                    <form action="{{ route('dashboard.clients.destroy', $client) }}" method="POST"
                                          onsubmit="return confirm('Delete this client?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
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

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $clients->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
