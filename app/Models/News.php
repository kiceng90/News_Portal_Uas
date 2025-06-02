<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'short_desc', 
        'content', 
        'author', 
        'slug', 
        'image', 
        'category_id', 
        'country_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function comments()
    {
        return $this->hasMany(NewsComment::class);
    }

    public function visits()
    {
        return $this->hasMany(NewsVisit::class);
    }

    public function shares()
    {
        return $this->hasMany(NewsShare::class);
    }
}
