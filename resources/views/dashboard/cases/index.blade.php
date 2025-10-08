<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Cases') }}
            </h2>
            <a href="{{ route('dashboard.cases.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Add Case
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <!-- Reusable Table Component -->
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
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium">{{ $case->title }}</td>
                                <td class="px-6 py-4 text-sm">{{ $case->client->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $case->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm capitalize">{{ $case->status }}</td>
                                <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                    <!-- View Button -->
                                    <a href="{{ route('dashboard.cases.show', $case) }}"
                                       class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                                        View
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('dashboard.cases.edit', $case) }}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </a>

                                    <!-- Delete Form -->
                                    <form action="{{ route('dashboard.cases.destroy', $case) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this case?');">
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
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No cases found.
                                </td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>
