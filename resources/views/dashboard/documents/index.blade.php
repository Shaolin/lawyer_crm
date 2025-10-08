<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Documents') }}
            </h2>
            <a href="{{ route('dashboard.documents.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Upload Document
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                
                <!-- Desktop Table View -->
                <div class="hidden md:block">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Case</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Uploaded By</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">File</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($documents as $document)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $document->title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $document->client->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $document->legalCase->title ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $document->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                           class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                            View File
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                        <a href="{{ route('dashboard.documents.show', $document) }}"
                                           class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100">
                                            View
                                        </a>

                                        <a href="{{ route('dashboard.documents.edit', $document) }}"
                                           class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                            Edit
                                        </a>

                                        <form action="{{ route('dashboard.documents.destroy', $document) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this document?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No documents found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card Layout -->
                <div class="block md:hidden divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($documents as $document)
                        <div class="p-4 flex flex-col space-y-2">
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ $document->title }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Client: {{ $document->client->name ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Case: {{ $document->legalCase->title ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Uploaded By: {{ $document->user->name ?? 'N/A' }}
                                </p>
                                <p class="text-sm">
                                    <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                       class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                        View File
                                    </a>
                                </p>
                            </div>

                            <div class="flex justify-end gap-4 pt-2">
                                <a href="{{ route('dashboard.documents.show', $document) }}"
                                   class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100">
                                    View
                                </a>
                                <a href="{{ route('dashboard.documents.edit', $document) }}"
                                   class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                    Edit
                                </a>
                                <form action="{{ route('dashboard.documents.destroy', $document) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this document?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="p-4 text-center text-gray-500 dark:text-gray-400">No documents found.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
