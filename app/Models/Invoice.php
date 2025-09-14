<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client_id', 'case_id', 'invoice_number', 'issue_date', 'due_date',
        'status', 'total_amount', 'organization_id', 'user_id'
    ];
    protected $casts = [
        'issue_date'   => 'date',
        'due_date'     => 'date',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function legalCase() {
        return $this->belongsTo(LegalCase::class, 'case_id');
    }

    public function items() {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

