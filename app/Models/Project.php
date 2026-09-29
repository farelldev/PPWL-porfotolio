<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'status'];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}