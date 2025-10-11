<?php



namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\LegalCase;
use App\Models\CaseModel; // 

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
                                ->orWhere('status', 'sent')
                                ->count();

        return view('dashboard.index', compact(
            'totalClients',
            'totalUsers',
            'pendingCases',
            'pendingInvoices'
        ));
    }
}


// user.php.  that is user model

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'organization_id',
    ];
    


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
