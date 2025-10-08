<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('dashboard.clients.create') }}" class="btn-primary w-full sm:w-auto text-center">
                + Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-900 text-xs uppercase text-gray-500 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left font-medium">Name</th>
                            <th scope="col" class="px-4 py-3 text-left font-medium">Email</th>
                            <th scope="col" class="px-4 py-3 text-left font-medium">Phone</th>
                            <th scope="col" class="px-4 py-3 text-right font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($clients as $client)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-gray-100">{{ $client->name }}</td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $client->email }}</td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $client->phone }}</td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ route('dashboard.clients.show', $client) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View</a>
                                    <a href="{{ route('dashboard.clients.edit', $client) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                                    <form action="{{ route('dashboard.clients.destroy', $client) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this client?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                    No clients found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</x-app-layout>
