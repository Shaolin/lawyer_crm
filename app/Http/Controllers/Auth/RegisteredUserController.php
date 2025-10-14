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
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone'        => ['required', 'string', 'max:20'], // ✅ phone validation
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'organization' => ['required', 'string', 'max:255'],
        ]);

        // ✅ Create the organization
        $organization = Organization::create([
            'name' => $request->organization,
        ]);

        // ✅ Create the user
        $user = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'phone'           => $request->phone, // ✅ Save phone
            'password'        => Hash::make($request->password),
            'organization_id' => $organization->id,
            'role'            => 'lawyer',
        ]);

        // ✅ Make the first user of the organization admin
        if ($organization->users()->count() === 1) {
            $user->role = 'admin';
            $user->save();
        }

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
