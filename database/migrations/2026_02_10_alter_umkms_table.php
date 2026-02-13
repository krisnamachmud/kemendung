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
        if (Schema::hasTable('umkms')) {
            Schema::table('umkms', function (Blueprint $table) {
                if (!Schema::hasColumn('umkms', 'email')) {
                    $table->string('email')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'latitude')) {
                    $table->decimal('latitude', 10, 8)->nullable();
                }
                if (!Schema::hasColumn('umkms', 'longitude')) {
                    $table->decimal('longitude', 11, 8)->nullable();
                }
                if (!Schema::hasColumn('umkms', 'jam_operasional')) {
                    $table->string('jam_operasional')->nullable();
                }
                if (!Schema::hasColumn('umkms', 'catatan')) {
                    $table->text('catatan')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('umkms')) {
            Schema::table('umkms', function (Blueprint $table) {
                if (Schema::hasColumn('umkms', 'email')) {
                    $table->dropColumn('email');
                }
                if (Schema::hasColumn('umkms', 'latitude')) {
                    $table->dropColumn('latitude');
                }
                if (Schema::hasColumn('umkms', 'longitude')) {
                    $table->dropColumn('longitude');
                }
                if (Schema::hasColumn('umkms', 'jam_operasional')) {
                    $table->dropColumn('jam_operasional');
                }
                if (Schema::hasColumn('umkms', 'catatan')) {
                    $table->dropColumn('catatan');
                }
            });
        }
    }
};
