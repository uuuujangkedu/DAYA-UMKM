<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@dayaumkm.id'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make(env('SUPERADMIN_PASSWORD', 'Admin123!')),
                'role' => 'super_admin',
                'status' => 'aktif',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'staf.admin@titik-umkm.id'],
            [
                'name' => 'Staf Admin Operasional',
                'phone_number' => '081234567891',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
                'status' => 'aktif',
                'email_verified_at' => now(),
            ]
        );
    }
}
