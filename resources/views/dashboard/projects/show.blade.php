<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Project Details') }}
            </h2>
            <a href="{{ route('dashboard.projects.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                Back to Projects
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">

                    <!-- Title -->
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        {{ $project->title }}
                    </h3>

                    <!-- Project Info -->
                    <div class="space-y-3 text-sm text-gray-700 dark:text-gray-300">
                        <p>
                            <span class="font-medium text-gray-900 dark:text-gray-100">Client:</span>
                            {{ $project->client->name ?? 'N/A' }}
                        </p>
                        <p>
                            <span class="font-medium text-gray-900 dark:text-gray-100">Lawyer:</span>
                            {{ $project->user->name ?? 'N/A' }}
                        </p>
                        <p>
                            <span class="font-medium text-gray-900 dark:text-gray-100">Status:</span>
                            <span class="capitalize">{{ $project->status }}</span>
                        </p>
                        <p>
                            <span class="font-medium text-gray-900 dark:text-gray-100">Created:</span>
                            {{ $project->created_at->format('M d, Y') }}
                        </p>
                        <p>
                            <span class="font-medium text-gray-900 dark:text-gray-100">Last Updated:</span>
                            {{ $project->updated_at->format('M d, Y') }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h4 class="font-semibold text-lg text-gray-900 dark:text-gray-100 mb-2">Description</h4>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">
                            {{ $project->description ?? 'No description provided.' }}
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                        <a href="{{ route('dashboard.projects.edit', $project) }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Edit
                        </a>

                        <form action="{{ route('dashboard.projects.destroy', $project) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
