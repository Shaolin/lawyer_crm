<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Invoices') }}
            </h2>
            <a href="{{ route('dashboard.invoices.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Add Invoice
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mobile Card View --}}
            <div class="sm:hidden space-y-4">
                @forelse($invoices as $invoice)
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg mb-2">
                            #{{ $invoice->invoice_number }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Client:</span> {{ $invoice->client->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Issued:</span> {{ $invoice->issue_date->format('Y-m-d') }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Due:</span> {{ $invoice->due_date->format('Y-m-d') }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                            <span class="font-medium">Total:</span> ₦{{ number_format($invoice->total_amount, 2) }}
                        </p>

                        <span class="inline-block mb-3 px-3 py-1 rounded-full text-xs font-medium
                            @if($invoice->status === 'paid') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                            @elseif($invoice->status === 'overdue') bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                            @elseif($invoice->status === 'sent') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                            @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 @endif">
                            {{ ucfirst($invoice->status) }}
                        </span>

                        <div class="flex items-center justify-end gap-4 pt-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('dashboard.invoices.show', $invoice) }}"
                               class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white text-sm">
                                View
                            </a>
                            <a href="{{ route('dashboard.invoices.edit', $invoice) }}"
                               class="text-indigo-600 hover:text-indigo-900 text-sm">
                                Edit
                            </a>
                            <form action="{{ route('dashboard.invoices.destroy', $invoice) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600 text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400 mt-6">No invoices found.</p>
                @endforelse
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden sm:block bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mt-4">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Invoice #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Issue Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Due Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase">Actions</th>
                        </tr>
                    </x-slot>

                    <x-slot name="body">
                        @forelse($invoices as $invoice)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium">#{{ $invoice->invoice_number }}</td>
                                <td class="px-6 py-4 text-sm">{{ $invoice->client->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $invoice->issue_date->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 text-sm">{{ $invoice->due_date->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 text-sm">₦{{ number_format($invoice->total_amount, 2) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($invoice->status === 'paid') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200
                                        @elseif($invoice->status === 'overdue') bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200
                                        @elseif($invoice->status === 'sent') bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200
                                        @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 @endif">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                    <a href="{{ route('dashboard.invoices.show', $invoice) }}"
                                       class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                                        View
                                    </a>
                                    <a href="{{ route('dashboard.invoices.edit', $invoice) }}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </a>
                                    <form action="{{ route('dashboard.invoices.destroy', $invoice) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No invoices found.
                                </td>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $invoices->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
