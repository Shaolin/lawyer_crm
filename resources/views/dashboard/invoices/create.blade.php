<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Invoice') }}
            </h2>
            <a href="{{ route('dashboard.invoices.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Back to Invoices
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('dashboard.invoices.store') }}" method="POST">
                    @csrf

                    <!-- Client -->
                    <div>
                        <x-input-label for="client_id" :value="__('Client')" />
                        <select id="client_id" name="client_id" required
                                class="block mt-1 w-full rounded-md border-gray-300">
                            <option value="">-- Select Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                    </div>

                    <!-- Issue Date -->
                    <div class="mt-4">
                        <x-input-label for="issue_date" :value="__('Issue Date')" />
                        <x-text-input id="issue_date" type="date" name="issue_date"
                                      class="block mt-1 w-full"
                                      value="{{ old('issue_date', now()->toDateString()) }}" required />
                        <x-input-error :messages="$errors->get('issue_date')" class="mt-2" />
                    </div>

                    <!-- Due Date -->
                    <div class="mt-4">
                        <x-input-label for="due_date" :value="__('Due Date')" />
                        <x-text-input id="due_date" type="date" name="due_date"
                                      class="block mt-1 w-full"
                                      value="{{ old('due_date', now()->addWeek()->toDateString()) }}" required />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>

                    <!-- Items -->
                    <div class="mt-6">
                        <h3 class="font-semibold text-lg">Invoice Items</h3>
                        <table class="min-w-full mt-2 border border-gray-200" id="items-table">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-2 py-1 border">Description</th>
                                    <th class="px-2 py-1 border">Qty</th>
                                    <th class="px-2 py-1 border">Unit Price</th>
                                    <th class="px-2 py-1 border">Total</th>
                                    <th class="px-2 py-1 border"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-2 py-1">
                                        <input type="text" name="items[0][description]" 
                                               class="w-full border-gray-300 rounded-md" required>
                                    </td>
                                    <td class="border px-2 py-1">
                                        <input type="number" name="items[0][quantity]" value="1" min="1"
                                               class="w-20 border-gray-300 rounded-md qty" required>
                                    </td>
                                    <td class="border px-2 py-1">
                                        <input type="number" step="0.01" name="items[0][unit_price]" value="0"
                                               class="w-24 border-gray-300 rounded-md price" required>
                                    </td>
                                    <td class="border px-2 py-1 total">0.00</td>
                                    <td class="border px-2 py-1 text-center">
                                        <button type="button" class="remove-row text-red-600">✕</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" id="add-row"
                                class="mt-2 px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                            + Add Item
                        </button>
                    </div>

                    <!-- Grand Total -->
                    <div class="mt-6 text-right">
                        <span class="font-semibold text-lg">Grand Total: ₦</span>
                        <span id="grand-total" class="font-bold text-lg">0.00</span>
                    </div>

                    
                   <!-- Status -->
<div class="mt-6">
    <x-input-label for="status" :value="__('Status')" />
    <select id="status" name="status"
            class="block mt-1 w-full rounded-md border-gray-300">
        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="sent" {{ old('status') == 'sent' ? 'selected' : '' }}>Sent</option>
        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
    <x-input-error :messages="$errors->get('status')" class="mt-2" />
</div>


                    <!-- Save Button -->
                    <div class="mt-6">
                        <x-primary-button>{{ __('Create Invoice') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS for dynamic rows + totals -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let rowCount = 1;

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

            document.getElementById('add-row').addEventListener('click', () => {
                const tbody = document.querySelector('#items-table tbody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="border px-2 py-1">
                        <input type="text" name="items[${rowCount}][description]" class="w-full border-gray-300 rounded-md" required>
                    </td>
                    <td class="border px-2 py-1">
                        <input type="number" name="items[${rowCount}][quantity]" value="1" min="1"
                               class="w-20 border-gray-300 rounded-md qty" required>
                    </td>
                    <td class="border px-2 py-1">
                        <input type="number" step="0.01" name="items[${rowCount}][unit_price]" value="0"
                               class="w-24 border-gray-300 rounded-md price" required>
                    </td>
                    <td class="border px-2 py-1 total">0.00</td>
                    <td class="border px-2 py-1 text-center">
                        <button type="button" class="remove-row text-red-600">✕</button>
                    </td>
                `;
                tbody.appendChild(newRow);
                rowCount++;
            });

            document.querySelector('#items-table').addEventListener('click', e => {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('tr').remove();
                    recalcTotals();
                }
            });

            recalcTotals();
        });
    </script>
</x-app-layout>
