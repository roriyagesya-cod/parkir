<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tb_tarif', function ($table) {
            $table->string('jenis_kendaraan', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_tarif', function ($table) {
            $table->enum('jenis_kendaraan', ['motor', 'mobil'])->change();
        });
    }
};