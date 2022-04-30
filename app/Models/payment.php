<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'id',
        'reference_id',
        'tenant_id',
        'bill_id',
        'amount',
        'receiver_id',
    ];

    public function tenant()
    {
        return $this->belongsTo(tenant::class);
    }
    public function bill()
    {
        return $this->belongsTo(bill::class);
    }
}
