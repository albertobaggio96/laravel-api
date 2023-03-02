<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=["title", "slug", "author", "date", "preview", "type_id"];
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(){
        return "slug";
    }

    public function isNotUrl(){
        return !filter_var($this->preview, FILTER_VALIDATE_URL);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}
