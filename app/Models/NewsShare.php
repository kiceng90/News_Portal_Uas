<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'user_id',
        'platform',
        'browser',
        'ip'
    ];

    public function news()
    {
        return $this->belongsTo(\App\Models\News::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
