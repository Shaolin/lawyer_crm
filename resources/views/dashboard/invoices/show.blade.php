<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Invoice #{{ $invoice->invoice_number }}
            </h2>
            <a href="{{ route('dashboard.invoices.index') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-500 transition-colors">
                ← Back to Invoices
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 sm:p-8 transition-all">

                <!-- Client Information -->
                <section class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                        Client Information
                    </h3>
                    <div class="text-gray-600 dark:text-gray-300 space-y-1">
                        <p class="font-medium text-base">{{ $invoice->client->name }}</p>
                        <p>{{ $invoice->client->email }}</p>
                        <p>{{ $invoice->client->phone }}</p>
                    </div>
                </section>

                <!-- Invoice Details -->
                <section class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                        Invoice Details
                    </h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 text-gray-600 dark:text-gray-300">
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
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($invoice->status === 'paid') bg-green-100 text-green-700 dark:bg-green-700 dark:text-green-100
                                    @elseif($invoice->status === 'overdue') bg-red-100 text-red-700 dark:bg-red-700 dark:text-red-100
                                    @elseif($invoice->status === 'sent') bg-blue-100 text-blue-700 dark:bg-blue-700 dark:text-blue-100
                                    @else bg-gray-100 text-gray-700 dark:bg-gray-600 dark:text-gray-200
                                    @endif">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </section>

                <!-- Invoice Items -->
                <section class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                        Invoice Items
                    </h3>
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-600 dark:text-gray-200">Description</th>
                                    <th class="px-4 py-2 text-center font-medium text-gray-600 dark:text-gray-200">Qty</th>
                                    <th class="px-4 py-2 text-right font-medium text-gray-600 dark:text-gray-200">Unit Price</th>
                                    <th class="px-4 py-2 text-right font-medium text-gray-600 dark:text-gray-200">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $item->description }}</td>
                                    <td class="px-4 py-2 text-center text-gray-700 dark:text-gray-300">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2 text-right text-gray-700 dark:text-gray-300">₦{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="px-4 py-2 text-right text-gray-700 dark:text-gray-300">₦{{ number_format($item->total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Total Amount -->
                <div class="flex justify-end border-t border-gray-200 dark:border-gray-700 pt-4">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">
                        Total: ₦{{ number_format($invoice->total_amount, 2) }}
                    </h3>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-wrap justify-end gap-3">
                    <a href="{{ route('dashboard.invoices.index') }}" 
                       class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg text-gray-800 dark:text-gray-200 text-sm font-medium transition">
                        Back
                    </a>
                    <a href="{{ route('dashboard.invoices.edit', $invoice) }}" 
                       class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg text-white text-sm font-medium transition">
                        Edit
                    </a>
                    <a href="{{ route('dashboard.invoices.download', $invoice) }}" 
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white text-sm font-medium transition">
                        Download PDF
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
