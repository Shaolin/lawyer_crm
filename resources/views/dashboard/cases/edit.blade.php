<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Edit Case') }}
            </h2>
            <a href="{{ route('dashboard.cases.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                Back to Cases
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden p-6">
                <!-- Update Form -->
                <form action="{{ route('dashboard.cases.update', $case) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" class="dark:text-gray-200"/>
                        <x-text-input id="title" class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                                      type="text" name="title"
                                      value="{{ old('title', $case->title) }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Client -->
                    <div class="mt-4">
                        <x-input-label for="client_id" :value="__('Client')" class="dark:text-gray-200" />
                        <select id="client_id" name="client_id"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('client_id', $case->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" class="dark:text-gray-200"/>
                        <select id="status" name="status"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="open" {{ old('status', $case->status) == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ old('status', $case->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="closed" {{ old('status', $case->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" class="dark:text-gray-200"/>
                        <textarea id="description" name="description" rows="4"
                                  class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">{{ old('description', $case->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Update Button -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <x-primary-button>{{ __('Update Case') }}</x-primary-button>
                    </div>
                </form>

                <!-- Delete Form (separate) -->
                <form action="{{ route('dashboard.cases.destroy', $case) }}" method="POST"
                      class="mt-4 flex justify-end"
                      onsubmit="return confirm('Are you sure you want to delete this case?');">
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
