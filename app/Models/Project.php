<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'status', 'thumbnail', 'category_id'];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

     public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }
}