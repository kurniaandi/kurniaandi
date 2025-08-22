<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',        // nama vendor
        'address',     // alamat vendor
        'phone',       // nomor telepon
        'email',       // email vendor
        'website',     // website vendor (optional)
        'contact_person', // nama PIC / sales
        'notes',       // catatan tambahan
    ];

    // Relasi ke aset
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
