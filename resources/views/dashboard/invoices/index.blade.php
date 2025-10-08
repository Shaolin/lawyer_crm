<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Invoices') }}
            </h2>
            <a href="{{ route('dashboard.invoices.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 dark:hover:bg-blue-500">
                + Add Invoice
            </a>
        </div>
    </x-slot>

    
                   <!-- Desktop Table -->
<div class="hidden md:block overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">#</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Client</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Issue Date</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Due Date</th>
                <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Total</th>
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Status</th>
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 dark:text-gray-300 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($invoices as $invoice)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">#{{ $invoice->invoice_number }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        {{ $invoice->client ? $invoice->client->name : 'N/A' }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        {{ $invoice->issue_date->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        {{ $invoice->due_date->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 text-right">
                        ₦{{ number_format($invoice->total_amount, 2) }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                            @if($invoice->status === 'paid') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                            @elseif($invoice->status === 'overdue') bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                            @elseif($invoice->status === 'sent') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                            @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 @endif">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center space-x-3">
                        <a href="{{ route('dashboard.invoices.show', $invoice) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">View</a>
                        <a href="{{ route('dashboard.invoices.edit', $invoice) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline text-sm">Edit</a>
                        <form action="{{ route('dashboard.invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Delete this invoice?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Mobile Card Layout -->
<div class="md:hidden space-y-4 p-4">
    @foreach($invoices as $invoice)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-gray-800 dark:text-gray-100">
                    #{{ $invoice->invoice_number }}
                </h3>
                <span class="px-2 py-1 rounded-full text-xs font-medium
                    @if($invoice->status === 'paid') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                    @elseif($invoice->status === 'overdue') bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                    @elseif($invoice->status === 'sent') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                    @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 @endif">
                    {{ ucfirst($invoice->status) }}
                </span>
            </div>

            <p class="text-sm text-gray-700 dark:text-gray-300">
                <strong>Client:</strong> {{ $invoice->client ? $invoice->client->name : 'N/A' }}
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                <strong>Issue Date:</strong> {{ $invoice->issue_date->format('Y-m-d') }}
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                <strong>Due Date:</strong> {{ $invoice->due_date->format('Y-m-d') }}
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">
                <strong>Total:</strong> ₦{{ number_format($invoice->total_amount, 2) }}
            </p>

            <div class="flex justify-end space-x-3 text-sm">
                <a href="{{ route('dashboard.invoices.show', $invoice) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View</a>
                <a href="{{ route('dashboard.invoices.edit', $invoice) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline">Edit</a>
                <form action="{{ route('dashboard.invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Delete this invoice?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

</x-app-layout>
