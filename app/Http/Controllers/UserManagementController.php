<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = Auth::user()->organization->users;
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20|unique:users', // ✅ added validation
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:lawyer,staff',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, // ✅ added
            'password' => Hash::make($request->password),
            'organization_id' => Auth::user()->organization_id,
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard.users.index')->with('success', 'User added successfully!');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id, // ✅ added validation
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:lawyer,staff',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; // ✅ added
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', 'User deleted successfully.');
    }
}
