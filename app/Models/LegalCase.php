<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'client_id',
        
    ];

    /**
     * The lawyer (user) handling the case.
     */
    public function lawyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The client involved in the case.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    // Each case belongs to a lawyer/user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each case belongs to a client
    
}
