<?php



namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\LegalCase;
use App\Models\CaseModel; // replace with your actual Case model class name

class DashboardController extends Controller
{
    public function index()
    {
        // Counts
        $totalClients   = Client::count();
        $totalUsers     = User::count();
        $pendingCases   = LegalCase::where('status', 'open')->count();
        $pendingInvoices= Invoice::where('status', 'unpaid')
                                ->orWhere('status', 'overdue')
                                ->count();

        return view('dashboard.index', compact(
            'totalClients',
            'totalUsers',
            'pendingCases',
            'pendingInvoices'
        ));
    }
}

