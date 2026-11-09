<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'status', 'thumbnail', 'category_id'];

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (blank($project->slug)) {
                $baseSlug = Str::slug($project->title) ?: 'project';
                $slug = $baseSlug;
                $suffix = 2;

                while (static::withTrashed()->where('slug', $slug)->exists()) {
                    $slug = $baseSlug.'-'.$suffix++;
                }

                $project->slug = $slug;
            }
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

     public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }
}