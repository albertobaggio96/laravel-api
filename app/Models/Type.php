<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'slug'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
