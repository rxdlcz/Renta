<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\location;
use App\Models\Unit;

class tenant extends Model
{
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'contact_number',
        'occupation_status',
        'unit_id',
        'start_id',
        'end_date',
        'status',
    ];

    public function location(){
        return $this->belongsTo(location::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function bill(){
        return $this->hasMany(bill::class, 'tenant_id', 'id');
    }

    public function payment(){
        return $this->hasMany(payment::class, 'tenant_id', 'id');
    }
}
