<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Case</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploaded By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">File</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($documents as $document)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $document->title }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $document->client->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $document->legalCase->title ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $document->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        View File
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                    <a href="{{ route('dashboard.documents.show', $document) }}"
                                       class="text-gray-600 hover:text-gray-900">View</a>

                                    <a href="{{ route('dashboard.documents.edit', $document) }}"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                    <form action="{{ route('dashboard.documents.destroy', $document) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this document?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No documents found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
