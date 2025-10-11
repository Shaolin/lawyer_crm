<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('dashboard.projects.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Add Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mobile Card View --}}
            <div class="sm:hidden space-y-4">
                @forelse($projects as $project)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg mb-2">
                            {{ $project->title }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Client:</span> {{ $project->client->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Assigned To:</span> {{ $project->user->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                            <span class="font-medium">Status:</span> {{ ucfirst($project->status) }}
                        </p>

                        <div class="flex items-center justify-end gap-4 pt-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('dashboard.projects.show', $project) }}"
                               class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white text-sm">
                                View
                            </a>
                            <a href="{{ route('dashboard.projects.edit', $project) }}"
                               class="text-indigo-600 hover:text-indigo-900 text-sm">
                                Edit
                            </a>
                            <form action="{{ route('dashboard.projects.destroy', $project) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this project?');">
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
                    <p class="text-center text-gray-500 dark:text-gray-400 mt-6">No projects found.</p>
                @endforelse
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden sm:block bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mt-4">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Assigned To</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase">Actions</th>
                        </tr>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($projects as $project)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium">{{ $project->title }}</td>
                                <td class="px-6 py-4 text-sm">{{ $project->client->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $project->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm capitalize">{{ $project->status }}</td>
                                <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                    <a href="{{ route('dashboard.projects.show', $project) }}"
                                       class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                                        View
                                    </a>
                                    <a href="{{ route('dashboard.projects.edit', $project) }}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </a>
                                    <form action="{{ route('dashboard.projects.destroy', $project) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this project?');">
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
                                    No projects found.
                                </td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table>
            </div>

        </div>
    </div>
</x-app-layout>
