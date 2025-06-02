<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\News;

class NewsApiController extends Controller
{
    public function index(): JsonResponse
    {
        $news = News::with(['category', 'country'])->get();

        return response()->json($news->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'category' => $item->category->name ?? null,
                'country' => $item->country->name ?? null
            ];
        }));
    }
}
