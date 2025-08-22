<?php

// app/Models/Technician.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    protected $fillable = ['user_id', 'specialist'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }
}
