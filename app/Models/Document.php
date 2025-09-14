<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'client_id',
        'legal_case_id',
        'user_id',
        'organization_id',
    ];

    //  Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function legalCase()
    {
        return $this->belongsTo(LegalCase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // uploaded by
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
