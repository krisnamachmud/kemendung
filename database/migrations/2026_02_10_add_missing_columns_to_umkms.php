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
                if (!Schema::hasColumn('umkms', 'ditampilkan')) {
                    $table->boolean('ditampilkan')->default(true);
                }
                if (!Schema::hasColumn('umkms', 'logo')) {
                    $table->string('logo')->nullable();
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
                if (Schema::hasColumn('umkms', 'ditampilkan')) {
                    $table->dropColumn('ditampilkan');
                }
                if (Schema::hasColumn('umkms', 'logo')) {
                    $table->dropColumn('logo');
                }
            });
        }
    }
};
