<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Upload Document') }}
            </h2>
            <a href="{{ route('dashboard.documents.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Back to Documents
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('dashboard.documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full"
                                      type="text" name="title"
                                      value="{{ old('title') }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Related Client -->
                    <div class="mt-4">
                        <x-input-label for="client_id" :value="__('Related Client (optional)')" />
                        <select id="client_id" name="client_id"
                                class="block mt-1 w-full rounded-md border-gray-300">
                            <option value="">-- None --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                    </div>

                    <!-- Related Case -->
                    <div class="mt-4">
                        <x-input-label for="legal_case_id" :value="__('Related Case (optional)')" />
                        <select id="legal_case_id" name="legal_case_id"
                                class="block mt-1 w-full rounded-md border-gray-300">
                            <option value="">-- None --</option>
                            @foreach($cases as $case)
                                <option value="{{ $case->id }}" {{ old('legal_case_id') == $case->id ? 'selected' : '' }}>
                                    {{ $case->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('legal_case_id')" class="mt-2" />
                    </div>

                    <!-- File Upload -->
                    <div class="mt-4">
                        <x-input-label for="file" :value="__('Upload File')" />
                        <input id="file" type="file" name="file"
                               class="block mt-1 w-full border-gray-300 rounded-md" required>
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                                  class="block mt-1 w-full rounded-md border-gray-300">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="mt-6">
                        <x-primary-button>{{ __('Upload Document') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
