<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kartars')) {
            Schema::create('kartars', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('jabatan');
                $table->string('foto')->nullable();
                $table->string('no_hp')->nullable();
                $table->text('alamat')->nullable();
                $table->integer('urutan')->default(0);
                $table->boolean('ditampilkan')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('kartar_kegiatan')) {
            Schema::create('kartar_kegiatan', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->string('slug')->unique();
                $table->text('deskripsi')->nullable();
                $table->date('tanggal');
                $table->string('lokasi')->nullable();
                $table->string('foto')->nullable();
                $table->boolean('ditampilkan')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kartar_kegiatan');
        Schema::dropIfExists('kartars');
    }
};
