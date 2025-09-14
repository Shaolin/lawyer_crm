<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Invoices') }}
            </h2>
            <a href="{{ route('dashboard.invoices.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                + Add Invoice
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-lg overflow-hidden">
                @if($invoices->isEmpty())
                    <div class="p-6 text-gray-600">
                        No invoices found.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Client</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Issue Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Due Date</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase">Total</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Status</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($invoices as $invoice)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-700">#{{ $invoice->invoice_number }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $invoice->client ? $invoice->client->name : 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $invoice->issue_date->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $invoice->due_date->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700 text-right">
                                            ₦{{ number_format($invoice->total_amount, 2) }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                                @if($invoice->status === 'paid') bg-green-100 text-green-800
                                                @elseif($invoice->status === 'overdue') bg-red-100 text-red-800
                                                @elseif($invoice->status === 'sent') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($invoice->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center space-x-3">
                                            <a href="{{ route('dashboard.invoices.show', $invoice) }}"
                                               class="text-blue-600 hover:underline text-sm">View</a>
                                            <a href="{{ route('dashboard.invoices.edit', $invoice) }}"
                                               class="text-yellow-600 hover:underline text-sm">Edit</a>
                                            <form action="{{ route('dashboard.invoices.destroy', $invoice) }}" 
                                                  method="POST" class="inline"
                                                  onsubmit="return confirm('Delete this invoice?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        {{ $invoices->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
