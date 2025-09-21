<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ $case->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden p-6 space-y-6">
                
                <!-- Client -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Client</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $case->client->name ?? 'N/A' }}</p>
                </div>

                <!-- Lawyer -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Lawyer</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $case->user->name ?? 'N/A' }}</p>
                </div>

                <!-- Status -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Status</h3>
                    <p class="capitalize text-gray-700 dark:text-gray-300">{{ $case->status }}</p>
                </div>

                <!-- Description -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Description</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $case->description }}</p>
                </div>

                <!-- Actions -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('dashboard.cases.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        Back
                    </a>
                    <a href="{{ route('dashboard.cases.edit', $case) }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Edit
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
