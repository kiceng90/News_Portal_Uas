<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountriesCategoriesNews extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_category_id',
        'news_id',
        'status'
    ];

    public function countryCategory()
    {
        return $this->belongsTo(CountriesCategory::class, 'country_category_id');
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
