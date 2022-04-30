<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id',
        'tenant_id',
        'bill_type',
        'amount_balance',
        'due_date',
        'status',
    ];

    public function tenant(){
        return $this->belongsTo(tenant::class);
    }

    public function payment(){
        return $this->hasMany(payment::class, 'bill_id', 'id');
    }
}
