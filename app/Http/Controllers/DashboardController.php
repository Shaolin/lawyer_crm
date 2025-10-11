<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\LegalCase;
use App\Models\Task;

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

        $pendingProjects = Project::where('organization_id', $organizationId)
            ->where('status', 'open')
            ->count();

        $pendingCases = LegalCase::where('organization_id', $organizationId)
            ->where('status', 'open')
            ->count();

        $pendingInvoices = Invoice::where('organization_id', $organizationId)
            ->whereIn('status', ['unpaid', 'overdue', 'sent'])
            ->count();

        //  NEW: Pending Tasks (status = pending)
        $pendingTasks = Task::where('organization_id', $organizationId)
            ->where('status', 'pending')
            ->count();

        return view('dashboard.index', compact(
            'totalClients',
            'totalUsers',
            'pendingCases',
            'pendingInvoices',
            'pendingProjects',
            'pendingTasks'
        ));
    }
}
