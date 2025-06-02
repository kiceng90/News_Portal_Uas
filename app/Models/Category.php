<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'countries_categories');
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
