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
        'location_id',
        'unit_id',
        'rent_id',
        'electric_id',
        'water_id',
    ];

    public function location(){
        return $this->belongsTo(location::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
