<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Edit Task') }}
            </h2>
            <a href="{{ route('dashboard.tasks.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                Back to Tasks
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Container -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden p-6">

                {{-- Update Form --}}
                <form action="{{ route('dashboard.tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                                      type="text" name="title"
                                      value="{{ old('title', $task->title) }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Related Case -->
                    <div class="mt-4">
                        <x-input-label for="legal_case_id" :value="__('Related Case (optional)')" />
                        <select id="legal_case_id" name="legal_case_id"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">-- None --</option>
                            @foreach($cases as $case)
                                <option value="{{ $case->id }}"
                                    {{ old('legal_case_id', $task->legal_case_id) == $case->id ? 'selected' : '' }}>
                                    {{ $case->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('legal_case_id')" class="mt-2" />
                    </div>

                    <!-- Due Date -->
                    <div class="mt-4">
                        <x-input-label for="due_date" :value="__('Due Date')" />
                        <x-text-input id="due_date" class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 
                         dark:text-gray-100 dark:placeholder-gray-400"
                                      type="date" name="due_date"
                                      value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                                      required />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                                  class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">{{ old('description', $task->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Task Type -->
                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Task Type')" />
                        <select id="type" name="type"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="general" {{ old('type', $task->type) == 'general' ? 'selected' : '' }}>General Task</option>
                            <option value="court_date" {{ old('type', $task->type) == 'court_date' ? 'selected' : '' }}>Court Date</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $task->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <!-- Update Button -->
                    <div class="mt-6 flex justify-end">
                        <x-primary-button>{{ __('Update Task') }}</x-primary-button>
                    </div>
                </form>

                {{-- Delete Form --}}
                <form action="{{ route('dashboard.tasks.destroy', $task) }}" method="POST"
                      class="mt-4 flex justify-end"
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
</x-app-layout>
