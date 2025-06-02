<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountriesCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'category_id',
        'status'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function countriesCategoriesNews()
    {
        return $this->hasMany(CountriesCategoriesNews::class);
    }
}
