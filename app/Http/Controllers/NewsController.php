<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;

class NewsController extends Controller
{
    // Menampilkan daftar berita, bisa filter by kategori
    public function index(Request $request)
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Filter berita berdasarkan kategori (jika ada query parameter category)
        $categoryId = $request->query('category');
        $newsQuery = News::with(['category', 'country']);

        if ($categoryId) {
            $newsQuery->where('category_id', $categoryId);
        }

        $newsList = $newsQuery->get();

        // Kirim data ke view
        return view('news.index', compact('newsList', 'categories'));
    }

    // Menampilkan detail berita
    public function show($id)
    {
        $news = News::with(['category', 'country'])->findOrFail($id);
        return view('news.show', compact('news'));
    }
}
