<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name',
        'status'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'countries_categories');
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
