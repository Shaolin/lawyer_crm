<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Document Details') }}
            </h2>
            <a href="{{ route('dashboard.documents.index') }}"
               class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                Back to Documents
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <!-- Title -->
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                    {{ $document->title }}
                </h3>

                <!-- Related Client -->
                @if($document->client)
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        <strong>Client:</strong> {{ $document->client->name }}
                    </p>
                @endif

                <!-- Related Case -->
                @if($document->legalCase)
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        <strong>Case:</strong> {{ $document->legalCase->title }}
                    </p>
                @endif

                <!-- Uploaded By -->
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    <strong>Uploaded by:</strong> {{ $document->user->name ?? 'Unknown' }}
                </p>

                <!-- Description -->
                @if($document->description)
                    <p class="mt-4 text-gray-700 dark:text-gray-200 whitespace-pre-line">
                        {{ $document->description }}
                    </p>
                @endif

                <!-- File -->
                <div class="mt-6">
                    <a href="{{ asset('storage/' . $document->file_path) }}" 
                       target="_blank"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500">
                        View / Download File
                    </a>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('dashboard.documents.edit', $document) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 dark:hover:bg-yellow-400">
                        Edit
                    </a>

                    <form action="{{ route('dashboard.documents.destroy', $document) }}" 
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this document?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-800">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
