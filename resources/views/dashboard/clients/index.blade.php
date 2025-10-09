<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('dashboard.clients.create') }}" class="btn-primary">
                + Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-12">
       <!-- Desktop Table -->
<div class="hidden sm:block">
    <x-table>
        <x-slot name="head">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Phone</th>
                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Actions</th>
            </tr>
        </x-slot>

        <x-slot name="body">
            @forelse($clients as $client)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $client->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $client->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $client->phone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
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
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No clients found.</td>
                </tr>
            @endforelse
        </x-slot>
    </x-table>
</div>

<!-- Mobile Cards -->
<div class="sm:hidden mt-4 space-y-4">
    @forelse($clients as $client)
        <x-mobile-card :model="$client" :fields="['name','email','phone']" route-prefix="dashboard.clients"/>
    @empty
        <p class="text-center text-gray-500 dark:text-gray-400">No clients found.</p>
    @endforelse
</div>

    </div>
</x-app-layout>
