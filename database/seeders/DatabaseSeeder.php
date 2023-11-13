<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Departemen;
use App\Models\JamMasuk;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\KonfigurasiLokasi;
use Database\Factories\KaryawanFactory;
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

        Departemen::create([
            'kode_dept' => 'MKT',
            'nama_dept' => 'Marketing'
        ]);

        Departemen::create([
            'kode_dept' => 'HRD',
            'nama_dept' => 'Human Resource Development'
        ]);

        Departemen::create([
            'kode_dept' => 'IT',
            'nama_dept' => 'Information Technology'
        ]);
        Karyawan::create([
            'nik' => '201',
            'nama_lengkap' => 'Ivan Christopher Sukandar',
            'jabatan' => 'HRD',
            'no_hp' => '087822221111',
            'password' => bcrypt('12345'),
            'kode_dept' => 'HRD'
        ]);

        Karyawan::create([
            'nik' => '202',
            'nama_lengkap' => 'Alvian Dwi Sanjaya',
            'jabatan' => 'Head of IT',
            'no_hp' => '08517373737',
            'password' => bcrypt('12345'),
            'kode_dept' => 'IT'
        ]);

        Karyawan::create([
            'nik' => '203',
            'nama_lengkap' => 'Adil Sandy Wardhani',
            'jabatan' => 'Marketing',
            'no_hp' => '08593212398',
            'password' => bcrypt('12345'),
            'kode_dept' => 'MKT'
        ]);

        Karyawan::factory(50)->create();

        User::create([
            'name' => 'Ivan Christopher Sukandar',
            'email' => 'ivan@gmail.com',
            'password' => bcrypt('12345')
        ]);

        KonfigurasiLokasi::create([
            'lokasi_kantor' => '-7.495028239338877,112.70850706055407',
            'radius' => '300'
        ]);

        JamMasuk::create([
            'jam' => '07:00'
        ]);
    }
}
