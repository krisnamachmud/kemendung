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
        if (!Schema::hasTable('umkms')) {
            Schema::create('umkms', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('slug')->unique();
                $table->text('deskripsi')->nullable();
                $table->string('kategori');
                $table->string('pemilik')->nullable();
                $table->string('kontak')->nullable();
                $table->string('email')->nullable();
                $table->string('logo')->nullable();
                $table->string('alamat')->nullable();
                $table->decimal('latitude', 10, 8)->nullable();
                $table->decimal('longitude', 11, 8)->nullable();
                $table->string('jam_operasional')->nullable();
                $table->text('catatan')->nullable();
                $table->boolean('ditampilkan')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
