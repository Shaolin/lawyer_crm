<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tasks') }}
            </h2>
            <a href="{{ route('dashboard.tasks.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Add Task
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Case</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assigned Lawyer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $task->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $task->legalCase->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $task->user->name ?? 'N/A' }}</td>
                                {{-- <td class="px-6 py-4 text-sm text-gray-600">{{ $task->due_date->format('M d, Y') }}</td> --}}
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}
                                </td>
                                
                                <td class="px-6 py-4 text-sm text-gray-600 capitalize">{{ $task->status }}</td>
                                <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                    <!-- View -->
                                    <a href="{{ route('dashboard.tasks.show', $task) }}"
                                       class="text-blue-600 hover:text-blue-900">View</a>

                                    <!-- Edit -->
                                    <a href="{{ route('dashboard.tasks.edit', $task) }}"
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                    <!-- Delete -->
                                    <form action="{{ route('dashboard.tasks.destroy', $task) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No tasks found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
