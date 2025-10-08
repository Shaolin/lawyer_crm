<x-app-layout>
    <x-slot name="header">
        <!-- Responsive Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Cases') }}
            </h2>
            <a href="{{ route('dashboard.cases.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 w-full sm:w-auto text-center">
                + Add Case
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Desktop Table -->
            <div class="hidden sm:block bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Lawyer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase">Actions</th>
                        </tr>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($cases as $case)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $case->title }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                    {{ $case->client->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                    {{ $case->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm capitalize text-gray-700 dark:text-gray-300">
                                    {{ $case->status }}
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium space-x-3">
                                    <a href="{{ route('dashboard.cases.show', $case) }}"
                                       class="text-blue-600 dark:text-blue-400 hover:underline">
                                        View
                                    </a>
                                    <a href="{{ route('dashboard.cases.edit', $case) }}"
                                       class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('dashboard.cases.destroy', $case) }}" method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this case?');">
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
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No cases found.
                                </td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table>
            </div>

            <!-- Mobile Card Layout -->
            <div class="sm:hidden space-y-4">
                @forelse($cases as $case)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 space-y-2">
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $case->title }}</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <strong>Client:</strong> {{ $case->client->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <strong>Lawyer:</strong> {{ $case->user->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <strong>Status:</strong> <span class="capitalize">{{ $case->status }}</span>
                        </p>
                        <div class="flex justify-between pt-2 border-t border-gray-200 dark:border-gray-700 text-sm">
                            <a href="{{ route('dashboard.cases.show', $case) }}"
                               class="text-blue-600 dark:text-blue-400 hover:underline">View</a>
                            <a href="{{ route('dashboard.cases.edit', $case) }}"
                               class="text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                            <form action="{{ route('dashboard.cases.destroy', $case) }}" method="POST"
                                  onsubmit="return confirm('Delete this case?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 dark:text-red-400 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400 py-4">No cases found.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
