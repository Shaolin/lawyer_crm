<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Organization;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            'organization' => ['required', 'string', 'max:255'],
        ]);
        
        //  Create the chamber/organization
        $organization = \App\Models\Organization::create([
        'name' => $request->organization,
    ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'organization_id' => $organization->id, // 
            'role'            => 'lawyer', 
        ]);
        // If this is the first user of the chamber, make them admin
        if ($organization->users()->count() === 1) {
         $user->role = 'admin';
            $user->save();
          }
        // dd($organization);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
 

public function createOrganizationForUser(User $user)
{
    if (!$user->organization) {
        $organization = Organization::create([
            'name' => $user->name . "'s Practice",
        ]);
        $user->organization_id = $organization->id;
        $user->save();
    }
}

}
