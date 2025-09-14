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
        // Admins can edit any client
        if ($user->role === 'admin') {
            return true;
        }

        // Lawyers can only edit clients they created
        if ($user->role === 'lawyer') {
            return $user->id === $client->user_id;
        }

        return false;
    }

    public function delete(User $user, Client $client)
    {
        // Only admins can delete
        return $user->role === 'admin';
    }
}
