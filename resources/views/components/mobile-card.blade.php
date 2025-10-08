

<div class="bg-white dark:bg-gray-900 shadow rounded-lg p-4">
    @foreach($fields as $field)
        <p class="text-sm text-gray-500 dark:text-gray-300">
            {{ ucfirst($field) }}: {{ $model->$field }}
        </p>
    @endforeach

    <div class="flex flex-col space-y-1 mt-2">
        <a href="{{ route($routePrefix.'.show', $model) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">View</a>
        <a href="{{ route($routePrefix.'.edit', $model) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">Edit</a>
        <form action="{{ route($routePrefix.'.destroy', $model) }}" method="POST" onsubmit="return confirm('Delete?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm text-left">Delete</button>
        </form>
    </div>
</div>
<hr class="border-gray-200 dark:border-gray-700">
