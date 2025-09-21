<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Edit Invoice') }}
            </h2>
            <a href="{{ route('dashboard.invoices.index') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 dark:hover:bg-indigo-500">
                ← Back to Invoices
            </a>
        </div>
    </x-slot>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded">
            <strong>Whoops! Something went wrong:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-5xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <form action="{{ route('dashboard.invoices.update', $invoice->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Client -->
                <div>
                    <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Client</label>
                    <select name="client_id" id="client_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
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
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <!-- Issue Date -->
                <div>
                    <label for="issue_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Issue Date</label>
                    <input type="date" id="issue_date" name="issue_date"
                           value="{{ old('issue_date', $invoice->issue_date->format('Y-m-d')) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <!-- Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                    <input type="date" id="due_date" name="due_date"
                           value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" id="status" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @foreach(['draft', 'sent', 'paid', 'overdue', 'cancelled'] as $st)
                            <option value="{{ $st }}" {{ old('status', $invoice->status) === $st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Invoice Items -->
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Invoice Items</h3>
                <div class="overflow-x-auto">
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
                                        <input type="text" name="items[{{ $index }}][description]"
                                               value="{{ old('items.'.$index.'.description', $item->description) }}"
                                               required
                                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    </td>
                                    <td class="border dark:border-gray-600 px-2 py-1">
                                        <input type="number" name="items[{{ $index }}][quantity]" min="1"
                                               value="{{ old('items.'.$index.'.quantity', $item->quantity) }}" required
                                               class="w-20 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    </td>
                                    <td class="border dark:border-gray-600 px-2 py-1">
                                        <input type="number" step="0.01" name="items[{{ $index }}][unit_price]"
                                               value="{{ old('items.'.$index.'.unit_price', $item->unit_price) }}" required
                                               class="w-28 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    </td>
                                    <td class="border dark:border-gray-600 px-2 py-1">
                                        <input type="number" step="0.01" name="items[{{ $index }}][total]" readonly
                                               value="{{ old('items.'.$index.'.total', $item->total) }}"
                                               class="w-28 rounded-md border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 shadow-sm">
                                    </td>
                                    <td class="border dark:border-gray-600 px-2 py-1 text-center">
                                        <button type="button"
                                                class="px-2 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                            X
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="button" id="add-item"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                    + Add Item
                </button>

                <!-- Total -->
                <div>
                    <label for="total_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Amount</label>
                    <input type="number" step="0.01" id="total_amount" name="total_amount" readonly
                           value="{{ old('total_amount', $invoice->total_amount) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 shadow-sm">
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500">
                        Update Invoice
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        let itemsTable = document.querySelector('#items-table tbody');
        let addItemBtn = document.getElementById('add-item');
        let rowCount = {{ count($invoice->items) }};

        addItemBtn.addEventListener('click', function () {
            let newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="border dark:border-gray-600 px-2 py-1"><input type="text" name="items[${rowCount}][description]" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm" required></td>
                <td class="border dark:border-gray-600 px-2 py-1"><input type="number" name="items[${rowCount}][quantity]" value="1" min="1" class="w-20 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm" required></td>
                <td class="border dark:border-gray-600 px-2 py-1"><input type="number" step="0.01" name="items[${rowCount}][unit_price]" class="w-28 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm" required></td>
                <td class="border dark:border-gray-600 px-2 py-1"><input type="number" step="0.01" name="items[${rowCount}][total]" class="w-28 rounded-md border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 shadow-sm" readonly></td>
                <td class="border dark:border-gray-600 px-2 py-1 text-center"><button type="button" class="px-2 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">X</button></td>
            `;
            itemsTable.appendChild(newRow);
            rowCount++;
        });

        itemsTable.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('tr').remove();
            }
        });
    });
    </script>
</x-app-layout>
