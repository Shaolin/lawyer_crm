<?php

namespace App\Policies;

use App\Models\LegalCase;
use App\Models\User;

class LegalCasePolicy
{
    /**
     * Determine whether the user can view any cases.
     */
    public function viewAny(User $user): bool
    {
        return true; // all logged-in users can view their cases
    }

    /**
     * Determine whether the user can view the case.
     */
    public function view(User $user, LegalCase $case): bool
    {
        return $user->role === 'admin' || $case->user_id === $user->id;
    }

    /**
     * Determine whether the user can create cases.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'lawyer']);
    }

    /**
     * Determine whether the user can update the case.
     */
    public function update(User $user, LegalCase $case): bool
    {
        return $user->role === 'admin' || $case->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the case.
     */
    public function delete(User $user, LegalCase $case): bool
    {
        return $user->role === 'admin' || $case->user_id === $user->id;
    }
}
