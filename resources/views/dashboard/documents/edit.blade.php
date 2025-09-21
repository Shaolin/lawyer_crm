<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Edit Document') }}
            </h2>
            <a href="{{ route('dashboard.documents.index') }}"
               class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                Back to Documents
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                
                <!-- Update Form -->
                <form action="{{ route('dashboard.documents.update', $document) }}" 
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" class="dark:text-gray-200" />
                        <x-text-input id="title"
                                      class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                      type="text" name="title"
                                      value="{{ old('title', $document->title) }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Related Client -->
                    <div class="mt-4">
                        <x-input-label for="client_id" :value="__('Related Client (optional)')" class="dark:text-gray-200" />
                        <select id="client_id" name="client_id"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            <option value="">-- None --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" 
                                    {{ old('client_id', $document->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                    </div>

                    <!-- Related Case -->
                    <div class="mt-4">
                        <x-input-label for="legal_case_id" :value="__('Related Case (optional)')" class="dark:text-gray-200" />
                        <select id="legal_case_id" name="legal_case_id"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            <option value="">-- None --</option>
                            @foreach($cases as $case)
                                <option value="{{ $case->id }}" 
                                    {{ old('legal_case_id', $document->legal_case_id) == $case->id ? 'selected' : '' }}>
                                    {{ $case->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('legal_case_id')" class="mt-2" />
                    </div>

                    <!-- Current File -->
                    <div class="mt-4">
                        <x-input-label :value="__('Current File')" class="dark:text-gray-200" />
                        <a href="{{ asset('storage/' . $document->file_path) }}" 
                           target="_blank" class="text-indigo-600 dark:text-indigo-400 underline">
                            View / Download
                        </a>
                    </div>

                    <!-- Replace File -->
                    <div class="mt-4">
                        <x-input-label for="file" :value="__('Replace File (optional)')" class="dark:text-gray-200" />
                        <input id="file" type="file" name="file"
                               class="block mt-1 w-full border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Leave empty to keep the current file.</p>
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" class="dark:text-gray-200" />
                        <textarea id="description" name="description" rows="4"
                                  class="block mt-1 w-full rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('description', $document->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Update Button -->
                    <div class="mt-6">
                        <x-primary-button>{{ __('Update Document') }}</x-primary-button>
                    </div>
                </form>

                <!-- Delete Form -->
                <form action="{{ route('dashboard.documents.destroy', $document) }}" 
                      method="POST" class="mt-4"
                      onsubmit="return confirm('Are you sure you want to delete this document?');">
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
</x-app-layout>
