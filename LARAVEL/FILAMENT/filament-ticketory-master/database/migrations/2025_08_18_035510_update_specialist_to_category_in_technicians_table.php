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
        Schema::table('technicians', function (Blueprint $table) {
            // hapus kolom specialist
            $table->dropColumn('specialist');

            // tambah kolom category_id
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null')
                ->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('technicians', function (Blueprint $table) {
            //
        });
    }
};
