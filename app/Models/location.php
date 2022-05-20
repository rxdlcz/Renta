<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;

class location extends Model
{
    protected $fillable = [
        'id',
        'location',
        'description',
    ];

    public function unit(){
        return $this->hasMany(Unit::class, 'location_id', 'id');
    }

    public function tenant(){
        return $this->hasMany(tenant::class, 'location_id', 'id');
    }
}
