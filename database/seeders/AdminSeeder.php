<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cek jika admin sudah ada
        $admin = User::where('email', 'admin@kemendung.local')->first();
        if (!$admin) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@kemendung.local',
                'password' => Hash::make('admin123'),
                'role' => 'administrator',
                'is_admin' => true,
            ]);
        }
    }
}
