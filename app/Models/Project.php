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

    protected $fillable = [
        'title', 'slug', 'category_id', 'short_description', 'description',
        'status', 'project_date', 'is_featured', 'project_url',
        'repository_url', 'thumbnail'
    ];

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}