<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('client')->orderBy('created_at', 'desc')->get();
        return view('dashboard.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('dashboard.invoices.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'issue_date'  => 'required|date',  // ✅ fixed
            'due_date'    => 'nullable|date|after_or_equal:issue_date', // ✅ fixed
            'status'      => 'required|in:unpaid,paid,overdue', // matches your blade form
        ]);

        $invoice = Invoice::create($validated);

        return redirect()
            ->route('dashboard.invoices.show', $invoice)
            ->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('client', 'items', 'payments');
        return view('dashboard.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $clients = Client::all();
        return view('dashboard.invoices.edit', compact('invoice', 'clients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'issue_date'  => 'required|date',  // ✅ fixed
            'due_date'    => 'nullable|date|after_or_equal:issue_date', // ✅ fixed
            'status'      => 'required|in:unpaid,paid,overdue',
        ]);

        $invoice->update($validated);

        return redirect()
            ->route('dashboard.invoices.show', $invoice)
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()
            ->route('dashboard.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }
}
