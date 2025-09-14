<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invoice #{{ $invoice->invoice_number }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                
                <!-- Client Information -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-3">Client Information</h3>
                    <p class="text-gray-600">
                        <span class="font-medium">{{ $invoice->client->name }}</span><br>
                        {{ $invoice->client->email }}<br>
                        {{ $invoice->client->phone }}
                    </p>
                </div>

                <!-- Invoice Details -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-3">Invoice Details</h3>
                    <dl class="grid grid-cols-2 gap-x-6 gap-y-2 text-gray-600">
                        <div>
                            <dt class="font-medium">Issue Date:</dt>
                            <dd>{{ $invoice->issue_date->format('M d, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium">Due Date:</dt>
                            <dd>{{ $invoice->due_date->format('M d, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium">Status:</dt>
                            <dd>
                                <span class="px-3 py-1 rounded-full text-sm 
                                    @if($invoice->status === 'paid') bg-green-100 text-green-700
                                    @elseif($invoice->status === 'overdue') bg-red-100 text-red-700
                                    @elseif($invoice->status === 'sent') bg-blue-100 text-blue-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <!-- Invoice Items -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-3">Invoice Items</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Description</th>
                                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Qty</th>
                                    <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Unit Price</th>
                                    <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $item->description }}</td>
                                    <td class="px-4 py-2 text-center text-sm text-gray-700">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2 text-right text-sm text-gray-700">₦{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="px-4 py-2 text-right text-sm text-gray-700">₦{{ number_format($item->total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="flex justify-end">
                    <h3 class="text-xl font-bold text-gray-800">
                        Total: ₦{{ number_format($invoice->total_amount, 2) }}
                    </h3>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex space-x-3">
                    <a href="{{ route('dashboard.invoices.index') }}" 
                       class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-gray-800 text-sm font-medium">
                        Back
                    </a>
                    <a href="{{ route('dashboard.invoices.edit', $invoice) }}" 
                       class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-md text-white text-sm font-medium">
                        Edit
                    </a>
                    <a href="{{ route('dashboard.invoices.download', $invoice) }}" 
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-white text-sm font-medium">
                        Download PDF
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
