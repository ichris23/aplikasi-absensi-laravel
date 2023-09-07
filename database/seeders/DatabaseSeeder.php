<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Karyawan::create([
            'nik' => '201',
            'nama_lengkap' => 'titit',
            'jabatan' => 'HRD',
            'no_hp' => '087822221111',
            'password' => bcrypt('12345'),
        ]);
    }
}
