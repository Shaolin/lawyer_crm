<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf; 

class InvoiceController extends Controller
{

    public function create()
    {
        $clients = Client::all();
        return view('dashboard.invoices.create', compact('clients'));
    }
    
  
    public function index()
    {
        $this->authorize('viewAny', Invoice::class);
    
        $invoices = Invoice::with('client')
            ->where(function ($query) {
                if (Auth::user()->role !== 'admin') {
                    $query->where('user_id', Auth::id());
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('dashboard.invoices.index', compact('invoices'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'                    => 'required|exists:clients,id',
            'issue_date'                   => 'required|date',
            'due_date'                     => 'nullable|date|after_or_equal:issue_date',
            
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
    
            'items'                        => 'required|array|min:1',
            'items.*.description'          => 'required|string|max:255',
            'items.*.quantity'             => 'required|integer|min:1',
            'items.*.unit_price'           => 'required|numeric|min:0',
        ]);
    
        // 1) Generate a unique invoice number (human-readable)
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5));
    
        // 2) Calculate total
        $total = 0;
        foreach ($validated['items'] as $it) {
            $total += $it['quantity'] * $it['unit_price'];
        }
    
        // 3) Prepare invoice data
        $invoiceData = [
            'client_id'      => $validated['client_id'],
            'invoice_number' => $invoiceNumber,
            'issue_date'     => $validated['issue_date'],
            'due_date'       => $validated['due_date'] ?? null,
            'status'         => $validated['status'],
            // adapt the next line if your column is named 'total' instead of 'total_amount'
            'total_amount'   => $total,
            'user_id'        => Auth::id(),
            'organization_id'=> Auth::user()->organization_id ?? null,
        ];
    
        // 4) Create invoice
        $invoice = Invoice::create($invoiceData);
    
        // 5) Create invoice items
        foreach ($validated['items'] as $it) {
            $invoice->items()->create([
                'description' => $it['description'],
                'quantity'    => $it['quantity'],
                'unit_price'  => $it['unit_price'],
                'total'       => $it['quantity'] * $it['unit_price'],
            ]);
        }
    
        return redirect()->route('dashboard.invoices.show', $invoice)
                         ->with('success', 'Invoice created successfully.');
    }
    
    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);
    
        $invoice->load('client', 'items', 'payments');
        return view('dashboard.invoices.show', compact('invoice'));
    }
    
    public function edit(Invoice $invoice)
    {
        $this->authorize('update', $invoice);
    
        $clients = Client::all();
        return view('dashboard.invoices.edit', compact('invoice', 'clients'));
    }
    
    public function update(Request $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);
        // rest of your update logic...
    }
    
    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);
        $invoice->delete();
    
        return redirect()
            ->route('dashboard.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }
    
    public function download(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        $invoice->load('client', 'items', 'payments');

        $pdf = Pdf::loadView('dashboard.invoices.pdf', compact('invoice'))
                  ->setPaper('a4');

        return $pdf->download($invoice->invoice_number . '.pdf');
    }



}
