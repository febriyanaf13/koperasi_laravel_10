<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\JenisBunga;
use App\Models\JenisPinjaman;
use App\Models\Nasabah;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Menggunakan factory untuk membuat user admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'status' => 'Aktif',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)// password admin
        ]);
        User::factory()->create([
            'name' => 'Anggota',
            'email' => 'anggota@gmail.com',
            'password' => Hash::make('anggota'),
            'status' => 'Aktif',
            'role' => 'anggota',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)// password admin
        ]);

        User::factory()->create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => Hash::make('operator'),
            'status' => 'Aktif',
            'role' => 'operator',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)// password admin
        ]);

        User::factory(10)->create();
        Role::factory(2)->sequence(
            ['name' => 'admin'],
            ['name' => 'anggota'],
        )->create();

        JenisPinjaman::factory()->create([
            'jenis_pinjaman' => 'Pinjaman Konsumsi',
            'maks_pinjaman' => 10000000,
            'lama_angsuran' => 6,
            'bunga' => 1,
        ]);
        JenisPinjaman::factory()->create([
            'jenis_pinjaman' => 'Pinjaman Pendidikan',
            'maks_pinjaman' => 20000000,
            'lama_angsuran' => 12,
            'bunga' => 0.5,
        ]);
        JenisPinjaman::factory()->create([
            'jenis_pinjaman' => 'Pinjaman Usaha Mikro',
            'maks_pinjaman' => 10000000,
            'lama_angsuran' => 6,
            'bunga' => 1,
        ]);
        JenisPinjaman::factory()->create([
            'jenis_pinjaman' => 'Pinjaman Darurat',
            'maks_pinjaman' => 5000000,
            'lama_angsuran' => 3,
            'bunga' => 1,
        ]);

        JenisBunga::factory()->create([
            'name' => 'Flat',
        ]);
    }
}
