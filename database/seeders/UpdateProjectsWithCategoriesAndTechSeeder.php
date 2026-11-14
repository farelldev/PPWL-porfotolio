<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UpdateProjectsWithCategoriesAndTechSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Kategori beserta slug
        $categoryNames = ['Web Application', 'Mobile App', 'UI/UX Design', 'REST API'];
        $categoryIds = [];

        foreach ($categoryNames as $name) {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
            $categoryIds[] = $category->id;
        }

        // 2. Buat Teknologi beserta slug
        $techNames = ['Laravel', 'Tailwind CSS', 'React', 'Vue.js', 'MySQL', 'Flutter'];
        $techIds = [];

        foreach ($techNames as $name) {
            $tech = Technology::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
            $techIds[] = $tech->id;
        }

        // 3. Lengkapi data pada 25 proyek yang sudah ada
        $sampleTopics = ['Laravel Blog', 'Sistem Akademik', 'E-Commerce Toko', 'Aplikasi Kasir', 'Portal Berita', 'Landing Page'];
        $projects = Project::all();

        foreach ($projects as $index => $project) {
            // Variasikan beberapa judul agar mudah dites saat search & sort A-Z
            $topic = $sampleTopics[$index % count($sampleTopics)];
            $newTitle = str_starts_with($project->title, 'Project tambahan')
                ? $topic . ' #' . ($index + 1)
                : $project->title;

            $project->update([
                'title'             => $newTitle,
                'slug'              => Str::slug($newTitle) . '-' . $project->id,
                'category_id'       => $categoryIds[array_rand($categoryIds)],
                'short_description' => 'Ringkasan singkat untuk ' . $newTitle,
                'description'       => $project->description . ' Dibangun menggunakan framework modern dan database relasional.',
                'project_date'      => now()->subDays(rand(1, 300)),
                'is_featured'       => $index < 3,
                'project_url'       => 'https://example.com/' . Str::slug($newTitle),
                'repository_url'    => 'https://github.com/username/' . Str::slug($newTitle),
            ]);

            // Pasangkan 2-3 teknologi secara acak ke tabel pivot
            $randomTechs = collect($techIds)->random(rand(2, 3))->toArray();
            $project->technologies()->sync($randomTechs);
        }
    }
}
