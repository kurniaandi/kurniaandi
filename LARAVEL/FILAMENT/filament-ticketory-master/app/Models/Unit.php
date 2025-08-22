<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'unit_location_id',
    ];

    // Relasi ke lokasi unit
    public function location()
    {
        return $this->belongsTo(UnitLocation::class, 'unit_location_id');
    }
}
