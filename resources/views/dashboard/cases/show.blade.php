<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $case->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <h3 class="text-lg font-semibold">Client</h3>
                    <p>{{ $case->client->name ?? 'N/A' }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Lawyer</h3>
                    <p>{{ $case->user->name ?? 'N/A' }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Status</h3>
                    <p class="capitalize">{{ $case->status }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Description</h3>
                    <p>{{ $case->description }}</p>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('dashboard.cases.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
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
