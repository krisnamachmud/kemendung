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
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->integer('penduduk_laki')->default(0);
            $table->integer('penduduk_perempuan')->default(0);
            $table->integer('kepala_keluarga')->default(0);
            $table->decimal('luas_wilayah', 10, 2)->default(0);
            $table->integer('jumlah_dusun')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistiks');
    }
};
