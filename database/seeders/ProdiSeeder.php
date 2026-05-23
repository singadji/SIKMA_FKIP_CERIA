<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_prodi' => 1,
                'nama_prodi' => 'Administrasi Pendidikan',
            ],
            [
                'kode_prodi' => 2,
                'nama_prodi' => 'Bimbingan Dan Konseling',
            ],
            [
                'kode_prodi' => 3,
                'nama_prodi' => 'Pendidikan Akuntansi',
            ],
            [
                'kode_prodi' => 4,
                'nama_prodi' => 'Pendidikan Bahasa Dan Sastra Indonesia',
            ],
            [
                'kode_prodi' => 5,
                'nama_prodi' => 'Pendidikan Bahasa Inggris',
            ],
            [
                'kode_prodi' => 6,
                'nama_prodi' => 'Pendidikan Bahasa Jerman',
            ],
            [
                'kode_prodi' => 7,
                'nama_prodi' => 'Pendidikan Biologi',
            ],
            [
                'kode_prodi' => 8,
                'nama_prodi' => 'Pendidikan Ekonomi',
            ],
            [
                'kode_prodi' => 9,
                'nama_prodi' => 'Pendidikan Fisika',
            ],
            [
                'kode_prodi' => 10,
                'nama_prodi' => 'Pendidikan Geografi',
            ],
            [
                'kode_prodi' => 11,
                'nama_prodi' => 'Pendidikan Guru Sekolah Dasar',
            ],
            [
                'kode_prodi' => 12,
                'nama_prodi' => 'Pendidikan Jasmani, Kesehatan & Rekreasi',
            ],
            [
                'kode_prodi' => 13,
                'nama_prodi' => 'Pendidikan Kimia',
            ],
            [
                'kode_prodi' => 14,
                'nama_prodi' => 'Pendidikan Luar Sekolah',
            ],
            [
                'kode_prodi' => 15,
                'nama_prodi' => 'Pendidikan Matematika',
            ],
            [
                'kode_prodi' => 16,
                'nama_prodi' => 'Pendidikan Sejarah',
            ],
            [
                'kode_prodi' => 17,
                'nama_prodi' => 'PPG',
            ],
            [
                'kode_prodi' => 18,
                'nama_prodi' => 'PPKn',
            ],
        ];

        DB::table('prodi')->insert($data);
    }
}