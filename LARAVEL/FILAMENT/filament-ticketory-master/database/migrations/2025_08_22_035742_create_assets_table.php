<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // nama aset
            $table->string('code')->unique();           // kode unik aset
            $table->foreignId('category_id')            // kategori aset
                ->constrained('categories')
                ->cascadeOnDelete();
            $table->foreignId('unit_id')                // lokasi aset disimpan
                ->constrained('units')
                ->cascadeOnDelete();
            $table->foreignId('vendor_id')              // vendor aset
                ->nullable()
                ->constrained('vendors')
                ->nullOnDelete();
            $table->enum('status', [                    // status aset
                'baik',
                'rusak',
            ])->default('baik');
            $table->date('purchase_date')->nullable();  // tanggal pembelian
            $table->decimal('purchase_price', 15, 2)    // harga beli
                ->nullable();
            $table->date('warranty_expiry')->nullable(); // masa garansi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
