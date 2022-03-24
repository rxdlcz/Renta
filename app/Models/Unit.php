<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\location;

class Unit extends Model
{
    protected $fillable = [
        'id',
        'name',
        'location_id',
        'price',
    ];

    public function location(){
        return $this->belongsTo(location::class);
    }
    
    public function tenant(){
        return $this->hasMany(tenant::class, 'location_id', 'id');
    }
}
