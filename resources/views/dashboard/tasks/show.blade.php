<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Task Details') }}
            </h2>
            <a href="{{ route('dashboard.tasks.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Back to Tasks
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                <!-- Title -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Title</h3>
                    <p class="text-gray-700">{{ $task->title }}</p>
                </div>

                <!-- Description -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Description</h3>
                    <p class="text-gray-700">{{ $task->description ?? 'No description provided.' }}</p>
                </div>

                <!-- Case -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Related Case</h3>
                    <p class="text-gray-700">{{ $task->legalCase->title ?? 'N/A' }}</p>
                </div>

                <!-- Assigned Lawyer -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Assigned Lawyer</h3>
                    <p class="text-gray-700">{{ $task->user->name ?? 'N/A' }}</p>
                </div>

                <!-- Due Date -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Due Date</h3>
                    <p class="text-gray-700">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'Not set' }}</p>
                    
                </div>

                <!-- Status -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Status</h3>
                    <p class="text-gray-700 capitalize">{{ $task->status }}</p>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('dashboard.tasks.edit', $task) }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Edit Task
                    </a>
                    <form action="{{ route('dashboard.tasks.destroy', $task) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
