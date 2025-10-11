<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\LegalCase;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Filter all counts by organization (chamber)
        $organizationId = $user->organization_id;

        // Counts scoped to the user's organization
        $totalClients = Client::where('organization_id', $organizationId)->count();

        $totalUsers = User::where('organization_id', $organizationId)->count();

        $pendingCases = LegalCase::where('organization_id', $organizationId)
            ->where('status', 'open')
            ->count();

        $pendingInvoices = Invoice::where('organization_id', $organizationId)
            ->whereIn('status', ['unpaid', 'overdue', 'sent'])
            ->count();

        return view('dashboard.index', compact(
            'totalClients',
            'totalUsers',
            'pendingCases',
            'pendingInvoices'
        ));
    }
}
