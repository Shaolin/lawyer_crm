<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtCase extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_id',
        'user_id',
        'client_id',
        'title',
        'description',
        'status',
        'court',
        'next_hearing_date',
    ];
     // Relationships
     public function organization()
     {
         return $this->belongsTo(Organization::class);
     }
 
     public function user()
     {
         return $this->belongsTo(User::class); // lawyer handling the case
     }
 
     public function client()
     {
         return $this->belongsTo(Client::class);
     }
}
