<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add Google OAuth fields to users table
        if (!Schema::hasColumn('users', 'google_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('google_id')->nullable()->unique()->after('email');
                $table->string('avatar')->nullable()->after('google_id');
                $table->boolean('is_admin')->default(false)->after('avatar');
                $table->string('password')->nullable()->change();
            });
        }

        // Create kritik_saran table
        if (!Schema::hasTable('kritik_saran')) {
            Schema::create('kritik_saran', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('email')->nullable();
                $table->string('no_hp')->nullable();
                $table->enum('jenis', ['kritik', 'saran', 'masukan', 'pertanyaan'])->default('masukan');
                $table->text('pesan');
                $table->enum('status', ['baru', 'dibaca', 'ditanggapi'])->default('baru');
                $table->text('tanggapan')->nullable();
                $table->timestamp('ditanggapi_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kritik_saran');

        if (Schema::hasColumn('users', 'google_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['google_id', 'avatar', 'is_admin']);
            });
        }
    }
};
