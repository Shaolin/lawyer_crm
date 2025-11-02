<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Client;
use App\Models\LegalCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents.
     */
    // public function index()
    // {
    //     $documents = Auth::user()->role === 'admin'
    //         ? Document::with('client', 'legalCase', 'user')->latest()->get()
    //         : Document::with('client', 'legalCase', 'user')
    //             ->where('organization_id', Auth::user()->organization_id)
    //             ->latest()
    //             ->get();

    //     return view('dashboard.documents.index', compact('documents'));
    // }
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Base query with relationships
        $query = Document::with(['client', 'legalCase', 'user']);
    
        // Restrict for non-admins
        if (Auth::user()->role !== 'admin') {
            $query->where('organization_id', Auth::user()->organization_id);
        }
    
        // Advanced Search
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($c) use ($search) {
                      $c->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('legalCase', function ($case) use ($search) {
                      $case->where('title', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }
    
        $documents = $query->latest()->paginate(10)->withQueryString();
    
        return view('dashboard.documents.index', compact('documents', 'search'));
    }
    
    /**
     * Show the form for creating a new document.
     */
    public function create()
{
    // Admin sees all cases, lawyer sees only their own
    $cases = Auth::user()->role === 'admin'
        ? LegalCase::all()
        : LegalCase::where('user_id', Auth::id())->get();

    // Same for clients
    $clients = Auth::user()->role === 'admin'
        ? Client::all()
        : Client::where('user_id', Auth::id())->get();

    return view('dashboard.documents.create', compact('cases', 'clients'));
}


    /**
     * Store a newly uploaded document.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
            'client_id'   => 'nullable|exists:clients,id',
            'legal_case_id' => 'nullable|exists:legal_cases,id',
        ]);

        // Save file
        $filePath = $request->file('file')->store('documents', 'public');

        Document::create([
            'title'          => $request->title,
            'description'    => $request->description,
            'file_path'      => $filePath,
            'client_id'      => $request->client_id,
            'legal_case_id'  => $request->legal_case_id,
            'user_id'        => Auth::id(),
            'organization_id'=> Auth::user()->organization_id,
        ]);

        return redirect()->route('dashboard.documents.index')->with('success', 'Document uploaded successfully.');
    }

   

    /**
     * Show the form for editing the specified document.
     */
    public function edit(Document $document)
    {
        $clients = Client::where('organization_id', Auth::user()->organization_id)->get();
    
        // Get cases that belong to clients in the same organization
        $cases = LegalCase::whereIn('client_id', $clients->pluck('id'))->get();
    
        return view('dashboard.documents.edit', compact('document', 'clients', 'cases'));
    }

    /**
     * Update the specified document.
     */
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
            'client_id'   => 'nullable|exists:clients,id',
            'legal_case_id' => 'nullable|exists:legal_cases,id',
        ]);

        // If new file uploaded
        if ($request->hasFile('file')) {
            // Delete old file
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $document->file_path = $request->file('file')->store('documents', 'public');
        }

        $document->update($request->only(['title', 'description', 'client_id', 'legal_case_id']));

        return redirect()->route('dashboard.documents.index')->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified document.
     */
    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('dashboard.documents.index')->with('success', 'Document deleted successfully.');
    }

    public function show(Document $document)
{
    // Eager-load relations
    $document->load(['client', 'legalCase', 'user']);

    return view('dashboard.documents.show', compact('document'));
}

}

