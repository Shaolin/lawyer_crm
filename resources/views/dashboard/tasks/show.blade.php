<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Task Details') }}
            </h2>
            <a href="{{ route('dashboard.tasks.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                Back to Tasks
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Card -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <div class="flex flex-col space-y-5 text-sm sm:text-base">

                    <!-- Title -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Title</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $task->title }}</p>
                    </div>

                    <!-- Description -->
                    <div class="flex flex-col border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">Description</h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $task->description ?? 'No description provided.' }}
                        </p>
                    </div>

                    <!-- Related Case -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Related Case</h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $task->legalCase->title ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Related Project -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Related Project</h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $task->project->title ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Assigned Lawyer -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Assigned Lawyer</h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $task->user->name ?? 'N/A' }}
                        </p>
                    </div>

                    
                <!-- Task Type with Badge -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Task Type</h3>
    <span class="@if($task->type === 'litigation') bg-red-100 text-red-800 dark:bg-red-600 dark:text-red-100 
                 @else bg-blue-100 text-blue-800 dark:bg-blue-600 dark:text-blue-100 @endif
                 px-3 py-1 rounded-full text-sm capitalize">
        {{ str_replace('_', ' ', $task->type) }}
    </span>
</div>

<!-- Priority with Badge -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Priority</h3>
    <span class="@if($task->priority === 'high') bg-red-100 text-red-800 dark:bg-red-600 dark:text-red-100
                 @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-600 dark:text-yellow-100
                 @else bg-green-100 text-green-800 dark:bg-green-600 dark:text-green-100 @endif
                 px-3 py-1 rounded-full text-sm capitalize">
        {{ $task->priority }}
    </span>
</div>

<!-- Status with Badge -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Status</h3>
    <span class="@if($task->status === 'completed') bg-green-100 text-green-800 dark:bg-green-600 dark:text-green-100
                 @elseif($task->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-600 dark:text-yellow-100
                 @else bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-100 @endif
                 px-3 py-1 rounded-full text-sm capitalize">
        {{ $task->status }}
    </span>
</div>

                    <!-- Due Date -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Due Date</h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $task->due_date ? $task->due_date->format('M d, Y') : 'Not set' }}
                        </p>
                    </div>

                    <!-- Status with Badge -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Status</h3>
                        <span class="@if($task->status === 'completed') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                     @elseif($task->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                     @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100 @endif
                                     px-3 py-1 rounded-full text-sm capitalize">
                            {{ $task->status }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap items-center justify-end gap-3 pt-4">
                        <a href="{{ route('dashboard.tasks.edit', $task) }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 w-full sm:w-auto text-center">
                            Edit Task
                        </a>
                        <form action="{{ route('dashboard.tasks.destroy', $task) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this task?');"
                              class="w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 w-full sm:w-auto">
                                Delete Task
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
