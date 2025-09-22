<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $organization = Auth::user()->organization;
        $clients = $organization->clients()->latest()->paginate(10);

        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function show(Client $client)
{
    return view('dashboard.clients.show', compact('client'));
}


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ]);

    $organization = Auth::user()->organization;

    $organization->clients()->create([
        'user_id' => Auth::id(), // 👈 ensures the lawyer/admin is linked
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'notes' => $request->notes,
    ]);

    return redirect()->route('dashboard.clients.index')->with('success', 'Client added successfully.');
}

    public function edit(Client $client)
{
    $this->authorize('view', $client); // optional if using policies
    return view('dashboard.clients.edit', compact('client'));
}

public function update(Request $request, Client $client)
{
    $this->authorize('update', $client);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email,' . $client->id,
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
    ]);

    $client->update($validated);

    return redirect()->route('dashboard.clients.index')->with('success', 'Client updated successfully.');
}

public function destroy(Client $client)
{
    $this->authorize('delete', $client);

    $client->delete();

    return redirect()->route('dashboard.clients.index')->with('success', 'Client deleted successfully.');
}

}
