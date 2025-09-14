<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['invoice_id', 'payment_date', 'amount', 'method', 'reference'];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
