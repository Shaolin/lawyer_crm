<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Edit Client') }}
            </h2>
            <a href="{{ route('dashboard.clients.index') }}" 
               class="btn-secondary">
                ← Back to Clients
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <!-- Update Form -->
                <form action="{{ route('dashboard.clients.update', $client) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" class="dark:text-gray-200"/>
                        <x-text-input id="name"
                                      class="block mt-1 w-full
                                      dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                                      type="text"
                                      name="name"
                                      value="{{ old('name', $client->name) }}"
                                      required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="dark:text-gray-200" />
                        <x-text-input id="email"
                                      class="block mt-1 w-full
                                      dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                                      type="email"
                                      name="email"
                                      value="{{ old('email', $client->email) }}"
                                      required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <x-input-label for="phone" :value="__('Phone')" class="dark:text-gray-200"/>
                        <x-text-input id="phone"
                                      class="block mt-1 w-full
                                      dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                                      type="text"
                                      name="phone"
                                      value="{{ old('phone', $client->phone) }}" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div>
                        <x-input-label for="address" :value="__('Address')" class="dark:text-gray-200" />
                        <textarea id="address"
                                  name="address"
                                  class="block mt-1 w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400">{{ old('address', $client->address) }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between">
                        <x-primary-button>
                            {{ __('Update Client') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Delete Form -->
                <form action="{{ route('dashboard.clients.destroy', $client) }}" method="POST"
                      class="mt-6"
                      onsubmit="return confirm('Are you sure you want to delete this client?');">
                    @csrf
                    @method('DELETE')
                    {{-- <button type="submit" class="btn-secondary bg-red-600 text-white hover:bg-red-700 px-4">
                        Delete
                    </button> --}}
                    <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Delete Task
            </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
