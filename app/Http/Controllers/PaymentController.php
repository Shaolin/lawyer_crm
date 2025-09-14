<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'method' => 'nullable|string|max:100',
        ]);

        $validated['invoice_id'] = $invoice->id;

        Payment::create($validated);

        return redirect()->route('dashboard.invoices.show', $invoice)
                         ->with('success', 'Payment recorded successfully.');
    }

    public function destroy(Payment $payment)
    {
        $invoice = $payment->invoice;
        $payment->delete();

        return redirect()->route('dashboard.invoices.show', $invoice)
                         ->with('success', 'Payment deleted successfully.');
    }
}
