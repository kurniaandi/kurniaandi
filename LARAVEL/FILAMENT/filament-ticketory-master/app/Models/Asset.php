<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',             // nama aset
        'code',             // kode unik aset
        'category_id',      // kategori aset
        'unit_id',          // lokasi aset disimpan
        'vendor_id',        // vendor / pemasok aset
        'status',           // aktif, dipinjam, rusak, hilang
        'purchase_date',    // tanggal pembelian
        'purchase_price',   // harga beli
        'warranty_expiry',  // masa garansi
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke unit/lokasi
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Relasi ke vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    // app/Models/Asset.php

    protected static function booted()
    {
        static::creating(function ($asset) {
            if (empty($asset->code)) {
                $month = now()->format('m');
                $year  = now()->format('Y');

                // Cari nomor terakhir di bulan & tahun yang sama
                $lastCode = self::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->orderByDesc('id')
                    ->value('code');

                if ($lastCode) {
                    // Ambil nomor urut terakhir dari format INV/XXXX/MM/YYYY
                    $lastNumber = (int) explode('/', $lastCode)[1];
                    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $newNumber = '0001';
                }

                $asset->code = "INV/{$newNumber}/{$month}/{$year}";
            }
        });
    }
}
