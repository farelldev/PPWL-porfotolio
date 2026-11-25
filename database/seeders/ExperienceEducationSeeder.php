<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::insert([
            [
                'position' => 'Full-Stack Web Developer',
                'company' => 'PT Teknologi ABCD',
                'period' => '2025 - Sekarang',
                'description' => 'Mengembangkan berbagai proyek aplikasi web menggunakan Laravel dan basis data MySQL untuk klien lokal..',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Asisten Praktikum Pemrograman Komputer',
                'company' => 'Universitas Gadjah Mada',
                'period' => '2026 - Sekarang',
                'description' => 'Membantu dosen dalam memandu mahasiswa pada mata kuliah Praktikum Pemrograman Komputer Dasar di Universitas Gadjah Mada.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Education::insert([
            [
                'institution' => 'Universitas Gadjah Mada',
                'degree' => 'Sarjana Terapan TRPL',
                'period' => '2023 - Sekarang',
                'description' => 'Berfokus pada pengembangan perangkat lunak, struktur data, dan arsitektur web.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'institution' => 'SMA Negeri 1 Pati',
                'degree' => 'Peminatan MIPA Murni',
                'period' => '2022 - 2025',
                'description' => 'Ya belajar materi SMA pada umumnya, pernah belajar dasar algoritma dan logika pemrograman dasar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
