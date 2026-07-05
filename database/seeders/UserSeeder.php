<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@dinas.go.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        $admin->assignRole('admin');

        // Keuangan
        $keuangan = User::firstOrCreate(
            ['email' => 'keuangan@dinas.go.id'],
            [
                'name' => 'Bagian Keuangan',
                'password' => Hash::make('password'),
            ]
        );

        $keuangan->assignRole('keuangan');

        // Kepala Dinas
        $kepala = User::firstOrCreate(
            ['email' => 'kepala@dinas.go.id'],
            [
                'name' => 'Kepala Dinas',
                'password' => Hash::make('password'),
            ]
        );

        $kepala->assignRole('kepala');
    }
}