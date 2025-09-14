<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
        

                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
 <!-- client policy -->

 <?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function viewAny(User $user)
    {
        return true; // all logged-in users can view client list
    }

    public function view(User $user, Client $client)
    {
        return $user->id === $client->user_id || $user->role === 'admin';
    }
    

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'lawyer']);
    }

    public function update(User $user, Client $client)
    {
        return $user->id === $client->user_id || $user->role === 'admin';

            // Lawyer can only edit clients they created
         return $user->id === $client->user_id;

    }
    

    public function delete(User $user, Client $client)
    {
        return $user->id === $client->user_id || $user->role === 'admin';
    }
}

// invoice controller

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
    
    public function index()
{
    $invoices = Invoice::with('client')
        ->orderBy('created_at', 'desc')
        ->paginate(10); // instead of get()

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
            'client_id'           => 'required|exists:clients,id',
            'invoice_number'      => 'required|string|max:255',
            'issue_date'          => 'required|date',
            'due_date'            => 'nullable|date|after_or_equal:issue_date',
            'status'              => 'required|in:draft,sent,paid,overdue,cancelled',
            'items'               => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.quantity'    => 'required|integer|min:1',
            'items.*.unit_price'  => 'required|numeric|min:0',
        ]);
    
        // ✅ Recalculate total
        $total = 0;
        foreach ($validated['items'] as $it) {
            $total += $it['quantity'] * $it['unit_price'];
        }
    
        // ✅ Update invoice main fields
        $invoice->update([
            'client_id'      => $validated['client_id'],
            'invoice_number' => $validated['invoice_number'],
            'issue_date'     => $validated['issue_date'],
            'due_date'       => $validated['due_date'],
            'status'         => $validated['status'],
            'total_amount'   => $total,
        ]);
    
        // ✅ Refresh items (delete old ones, insert new ones)
        $invoice->items()->delete();
        foreach ($validated['items'] as $it) {
            $invoice->items()->create([
                'description' => $it['description'],
                'quantity'    => $it['quantity'],
                'unit_price'  => $it['unit_price'],
                'total'       => $it['quantity'] * $it['unit_price'],
            ]);
        }
    
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
   

public function download(Invoice $invoice)
{
    $invoice->load('client', 'items', 'payments');

    $pdf = Pdf::loadView('dashboard.invoices.pdf', compact('invoice'));

    return $pdf->download($invoice->invoice_number . '.pdf');
}

}
