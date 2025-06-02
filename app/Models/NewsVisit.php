<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'ip',
        'user_agent',
        'referer',
        'browser',
        'platform',
        'visited_at'
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
