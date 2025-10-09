<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-2">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Edit Invoice') }}
            </h2>
            <a href="{{ route('dashboard.invoices.index') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-500">
                ← Back to Invoices
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg">
                    <strong>Whoops! Something went wrong:</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">
                <form action="{{ route('dashboard.invoices.update', $invoice->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Client -->
                    <div>
                        <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Client</label>
                        <select name="client_id" id="client_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Invoice Number -->
                    <div>
                        <label for="invoice_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Invoice Number</label>
                        <input type="text" id="invoice_number" name="invoice_number"
                               value="{{ old('invoice_number', $invoice->invoice_number) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="issue_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Issue Date</label>
                            <input type="date" id="issue_date" name="issue_date"
                                   value="{{ old('issue_date', $invoice->issue_date->format('Y-m-d')) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                            <input type="date" id="due_date" name="due_date"
                                   value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status" required
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            @foreach(['draft', 'sent', 'paid', 'overdue', 'cancelled'] as $st)
                                <option value="{{ $st }}" {{ old('status', $invoice->status) === $st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Invoice Items -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Invoice Items</h3>

                        <div class="overflow-x-auto mt-2">
                            <table class="min-w-full border border-gray-200 dark:border-gray-600 rounded-md" id="items-table">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 border dark:border-gray-600 text-left text-gray-700 dark:text-gray-300">Description</th>
                                        <th class="px-3 py-2 border dark:border-gray-600 text-left text-gray-700 dark:text-gray-300">Qty</th>
                                        <th class="px-3 py-2 border dark:border-gray-600 text-left text-gray-700 dark:text-gray-300">Unit Price</th>
                                        <th class="px-3 py-2 border dark:border-gray-600 text-left text-gray-700 dark:text-gray-300">Total</th>
                                        <th class="px-3 py-2 border dark:border-gray-600"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->items as $index => $item)
                                        <tr>
                                            <td class="border dark:border-gray-600 px-2 py-1">
                                                <input type="text" name="items[{{ $index }}][description]" value="{{ $item->description }}"
                                                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200" required>
                                            </td>
                                            <td class="border dark:border-gray-600 px-2 py-1">
                                                <input type="number" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" min="1"
                                                       class="qty w-20 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200" required>
                                            </td>
                                            <td class="border dark:border-gray-600 px-2 py-1">
                                                <input type="number" step="0.01" name="items[{{ $index }}][unit_price]" value="{{ $item->unit_price }}"
                                                       class="price w-28 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200" required>
                                            </td>
                                            <td class="border dark:border-gray-600 px-2 py-1 total text-gray-700 dark:text-gray-200">{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                            <td class="border dark:border-gray-600 px-2 py-1 text-center">
                                                <button type="button" class="remove-row text-red-600 dark:text-red-400">✕</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button type="button" id="add-item"
                                class="mt-3 px-3 py-2 w-full sm:w-auto bg-green-600 text-white rounded hover:bg-green-700 dark:hover:bg-green-500">
                            + Add Item
                        </button>
                    </div>

                    <!-- Grand Total -->
                    <div class="mt-6 text-center sm:text-right text-gray-800 dark:text-gray-100">
                        <span class="font-semibold text-lg">Grand Total: ₦</span>
                        <span id="grand-total" class="font-bold text-lg">{{ number_format($invoice->total_amount, 2) }}</span>
                    </div>

                    <!-- Sticky Update Button -->
                    <div class="sticky bottom-0 bg-white dark:bg-gray-800 py-4 mt-8 border-t border-gray-200 dark:border-gray-700">
                        <x-primary-button class="w-full sm:w-auto">{{ __('Update Invoice') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS for dynamic rows + totals -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let rowCount = {{ count($invoice->items) }};
            const itemsTable = document.querySelector('#items-table tbody');

            function recalcTotals() {
                let grandTotal = 0;
                document.querySelectorAll('#items-table tbody tr').forEach(row => {
                    const qty = parseFloat(row.querySelector('.qty').value) || 0;
                    const price = parseFloat(row.querySelector('.price').value) || 0;
                    const total = qty * price;
                    row.querySelector('.total').textContent = total.toFixed(2);
                    grandTotal += total;
                });
                document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
            }

            document.getElementById('items-table').addEventListener('input', recalcTotals);

            document.getElementById('add-item').addEventListener('click', () => {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="border dark:border-gray-600 px-2 py-1">
                        <input type="text" name="items[${rowCount}][description]" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200" required>
                    </td>
                    <td class="border dark:border-gray-600 px-2 py-1">
                        <input type="number" name="items[${rowCount}][quantity]" value="1" min="1"
                               class="qty w-20 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200" required>
                    </td>
                    <td class="border dark:border-gray-600 px-2 py-1">
                        <input type="number" step="0.01" name="items[${rowCount}][unit_price]" value="0"
                               class="price w-28 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200" required>
                    </td>
                    <td class="border dark:border-gray-600 px-2 py-1 total text-gray-700 dark:text-gray-200">0.00</td>
                    <td class="border dark:border-gray-600 px-2 py-1 text-center">
                        <button type="button" class="remove-row text-red-600 dark:text-red-400">✕</button>
                    </td>
                `;
                itemsTable.appendChild(newRow);
                rowCount++;
            });

            itemsTable.addEventListener('click', e => {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('tr').remove();
                    recalcTotals();
                }
            });

            recalcTotals();
        });
    </script>
</x-app-layout>
