<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            Project::create([
                'title'         => 'Project tambahan ke-' . $i,
                'description'   => 'Deskripsi project tambahan ke-' . $i,
                'status'        => fake()->randomElement(['draft', 'published']),
            ]);
        }
    }
}
