<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
            {{ __('Edit User') }}
        </h2>
        <div>
            <a href="{{ route('dashboard.users.index') }}"
               class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">
               ← Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('dashboard.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Full Name')" class="dark:text-gray-200"/>
                            <x-text-input id="name" class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                          type="text" name="name" value="{{ old('name', $user->name) }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" class="dark:text-gray-200"/>
                            <x-text-input id="email" class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                          type="email" name="email" value="{{ old('email', $user->email) }}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
<div class="mt-4">
    <x-input-label for="phone" :value="__('Phone Number')" class="dark:text-gray-200"/>
    <x-text-input id="phone" 
                  class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                  type="text" 
                  name="phone" 
                  value="{{ old('phone', $user->phone) }}" 
                  placeholder="+2348012345678" 
                  required />
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>


                        <!-- Password (optional update) -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password (leave blank to keep current)')" class="dark:text-gray-200"/>
                            <x-text-input id="password" class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                          type="password" name="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>


                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="dark:text-gray-200"/>
                            <x-text-input id="password_confirmation" class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                                          type="password" name="password_confirmation" />
                        </div>

                        <!-- Role -->
                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Role')" class="dark:text-gray-200"/>
                            <select id="role" name="role"
                                    class="block mt-1 w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                                <option value="lawyer" {{ $user->role === 'lawyer' ? 'selected' : '' }}>Lawyer</option>
                                <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <!-- Submit -->
                        <div class="mt-6">
                            <x-primary-button>
                                {{ __('Update User') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
