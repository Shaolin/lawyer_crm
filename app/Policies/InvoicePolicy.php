<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function viewAny(User $user)
    {
        return true; // All logged-in users can see their invoices list
    }

    public function view(User $user, Invoice $invoice)
    {
        return $user->role === 'admin' || $user->id === $invoice->user_id;
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'lawyer']);
    }

    public function update(User $user, Invoice $invoice)
    {
        if ($user->role === 'admin') {
            return true;
        }
        return $user->id === $invoice->user_id;
    }

    public function delete(User $user, Invoice $invoice)
    {
        return $user->role === 'admin'; // Only admins can delete
    }
}
