<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Add Task') }}
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
                <form action="{{ route('dashboard.tasks.store') }}" method="POST">
                    @csrf

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" class="dark:text-gray-200"/>
                        <x-text-input id="title"
                                      class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                      type="text" name="title"
                                      value="{{ old('title') }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- 🔹 Assigned Lawyer (Admins Only) -->
                    @if(auth()->user()->role === 'admin')
                        <div class="mt-4">
                            <x-input-label for="assigned_to" :value="__('Assign to Lawyer')" class="dark:text-gray-200"/>
                            <select id="assigned_to" name="assigned_to"
                                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                <option value="">-- Select Lawyer (or leave blank to assign yourself) --</option>
                                @foreach($lawyers as $lawyer)
                                    <option value="{{ $lawyer->id }}" {{ old('assigned_to') == $lawyer->id ? 'selected' : '' }}>
                                        {{ $lawyer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                        </div>
                    @endif

                    <!-- Related Case -->
                    <div class="mt-4">
                        <x-input-label for="legal_case_id" :value="__('Related Case (optional)')" class="dark:text-gray-200"/>
                        <select id="legal_case_id" name="legal_case_id"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">-- None --</option>
                            @foreach($cases as $case)
                                <option value="{{ $case->id }}" {{ old('legal_case_id') == $case->id ? 'selected' : '' }}>
                                    {{ $case->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('legal_case_id')" class="mt-2" />
                    </div>

                    <!-- Related Project -->
                    <div class="mt-4">
                        <x-input-label for="project_id" :value="__('Related Project (optional)')" class="dark:text-gray-200"/>
                        <select id="project_id" name="project_id"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">-- None --</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                    </div>

                    <!-- Task Type -->
                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Task Type')" class="dark:text-gray-200"/>
                        <select id="type" name="type"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="litigation" {{ old('type') == 'litigation' ? 'selected' : '' }}>Litigation</option>
                            <option value="non_litigation" {{ old('type') == 'non_litigation' ? 'selected' : '' }}>Non-Litigation</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- Task Priority -->
                    <div class="mt-4">
                        <x-input-label for="priority" :value="__('Priority')" class="dark:text-gray-200"/>
                        <select id="priority" name="priority"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        </select>
                        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" class="dark:text-gray-200"/>
                        <select id="status" name="status"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <!-- Due Date -->
                    <div class="mt-4">
                        <x-input-label for="due_date" :value="__('Due Date')" class="dark:text-gray-200"/>
                        <x-text-input id="due_date"
                                      class="block mt-1 w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                      type="date" name="due_date"
                                      value="{{ old('due_date') }}" required />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" class="dark:text-gray-200" />
                        <textarea id="description" name="description" rows="4"
                                  class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="mt-6 flex justify-end">
                        <x-primary-button>{{ __('Create Task') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
