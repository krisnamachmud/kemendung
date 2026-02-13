<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Perangkat;
use App\Models\Statistik;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DesaSeeder::class);
    }
}
