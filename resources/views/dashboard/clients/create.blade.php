<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Add Client') }}
            </h2>

            <a href="{{ route('dashboard.clients.index') }}"
               class="btn-secondary">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('dashboard.clients.store') }}" class="space-y-6">
                    @csrf

                    <!-- Full Name -->
                   
<div>
    <x-input-label for="name" :value="__('Full Name')"  class="dark:text-gray-200"/>
    <x-text-input id="name"
                  name="name"
                  type="text"
                  class="block mt-1 w-full 
                         dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                  :value="old('name')"
                  required autofocus />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Email -->
<div>
    <x-input-label for="email" :value="__('Email')" class="dark:text-gray-200" />
    <x-text-input id="email"
                  name="email"
                  type="email"
                  class="block mt-1 w-full 
                         dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                  :value="old('email')" />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Phone -->
<div>
    <x-input-label for="phone" :value="__('Phone')" class="dark:text-gray-200"/>
    <x-text-input id="phone"
                  name="phone"
                  type="text"
                  class="block mt-1 w-full 
                         dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                  :value="old('phone')" />
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>


                    


                    <!-- Address -->
                    <div>
                        <x-input-label for="address" :value="__('Address')" class="dark:text-gray-200" />
                        <textarea id="address"
                                  name="address"
                                  rows="3"
                                  class="block mt-1 w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400">{{ old('address') }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Notes -->
                    <div>
                        <x-input-label for="notes" :value="__('Notes')" class="dark:text-gray-200" />
                        <textarea id="notes"
                                  name="notes"
                                  rows="4"
                                  class="block mt-1 w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary">
                            Save Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
