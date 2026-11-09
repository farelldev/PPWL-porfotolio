<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        DB::table('projects')->orderBy('id')->get(['id', 'title'])->each(function ($project) {
            $baseSlug = Str::slug($project->title) ?: 'project';
            $slug = $baseSlug;
            $suffix = 2;

            while (DB::table('projects')->where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$suffix++;
            }

            DB::table('projects')->where('id', $project->id)->update(['slug' => $slug]);
        });

        Schema::table('project_images', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('project_images', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn(['project_id', 'image', 'caption', 'sort_order']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};