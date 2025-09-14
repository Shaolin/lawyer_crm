<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LegalCaseController extends Controller
{
    public function index()
    {
        // Admin sees all cases, lawyers see only their own
        $cases = Auth::user()->role === 'admin'
            ? LegalCase::with('client', 'user')->latest()->get()
            : LegalCase::with('client', 'user')->where('user_id', Auth::id())->latest()->get();

        return view('dashboard.cases.index', compact('cases'));
    }

    public function create()
    {
        // Get the lawyer's organization ID
        $organizationId = Auth::user()->organization_id;
    
        // Fetch all clients belonging to that organization
        $clients = Client::where('organization_id', $organizationId)->get();
    
        return view('dashboard.cases.create', compact('clients'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:open,in_progress,closed',
            'client_id'   => 'required|exists:clients,id',
        ]);
    
        LegalCase::create([
            'title'           => $request->title,
            'description'     => $request->description,
            'status'          => $request->status,
            'user_id'         => Auth::id(), // logged-in lawyer
            'organization_id' => Auth::user()->organization_id, // chamber/org
            'client_id'       => $request->client_id,
        ]);
    
        return redirect()->route('dashboard.cases.index')
                         ->with('success', 'Case created successfully.');
    }
    

    public function edit(LegalCase $case)
{
    $this->authorize('update', $case);

    $clients = Client::all();
    return view('dashboard.cases.edit', compact('case', 'clients'));
}

public function update(Request $request, LegalCase $case)
{
    $this->authorize('update', $case);

    $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'status'      => 'required|in:open,in_progress,closed',
        'client_id'   => 'required|exists:clients,id',
    ]);

    $case->update($request->all());

    return redirect()->route('dashboard.cases.index')->with('success', 'Case updated successfully.');
}

public function destroy(LegalCase $case)
{
    $this->authorize('delete', $case);

    $case->delete();

    return redirect()->route('dashboard.cases.index')->with('success', 'Case deleted successfully.');
}
public function show(LegalCase $case)
{
    $this->authorize('view', $case); // enforce policy

    return view('dashboard.cases.show', compact('case'));
}


     

}
