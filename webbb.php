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
