<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\NewsComment;
use App\Models\NewsShare;
use App\Models\NewsVisit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestFacade;

class NewsController extends Controller
{
    // Menampilkan daftar berita, bisa filter by kategori
    public function index(Request $request)
    {
        // Ambil semua kategori
        $categories = Category::all();

        // Filter berita berdasarkan kategori
        $categoryId = $request->query('category');

        $newsQuery = News::with(['category', 'country']);

        if ($categoryId) {
            $newsQuery->where('category_id', $categoryId);
        }

        $newsList = $newsQuery->get();

        return view('news.index', compact('newsList', 'categories'));
    }

    // Menampilkan detail berita
    public function show(Request $request, $id)
    {
        // Ambil berita beserta relasi
        $news = News::with(['category', 'country'])->findOrFail($id);

        // Simpan kunjungan
        NewsVisit::create([
            'news_id' => $id,
            'ip' => RequestFacade::ip(),
            'user_agent' => RequestFacade::header('User-Agent'),
            'browser' => $this->getBrowser(RequestFacade::header('User-Agent')),
            'platform' => php_uname('s'),
            'visited_at' => now()
        ]);

        // Ambil komentar utama + balasan
        $comments = NewsComment::where('news_id', $id)
                                ->whereNull('parent_id')
                                ->with(['user', 'replies.user'])
                                ->get();

        return view('news.show', compact('news', 'comments'));
    }

    // Fungsi untuk menentukan browser dari user agent
    private function getBrowser($userAgent)
    {
        if (str_contains($userAgent, 'Firefox')) {
            return 'Firefox';
        } elseif (str_contains($userAgent, 'Edg')) {
            return 'Edge';
        } elseif (str_contains($userAgent, 'Chrome')) {
            return 'Chrome';
        } elseif (str_contains($userAgent, 'Safari')) {
            return 'Safari';
        } elseif (str_contains($userAgent, 'MSIE') || str_contains($userAgent, 'Trident')) {
            return 'Internet Explorer';
        } else {
            return 'Unknown';
        }
    }

    // Menyimpan komentar
    public function storeComment(Request $request, $newsId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:news_comments,id'
        ]);

        NewsComment::create([
            'news_id' => $newsId,
            'user_id' => Auth::id(),
            'parent_id' => $request->input('parent_id'),
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function storeShare(Request $request, $newsId)
    {
        NewsShare::create([
            'news_id' => $newsId,
            'user_id' => Auth::check() ? Auth::id() : null,
            'platform' => $request->query('platform') ?: 'unknown',
            'browser' => RequestFacade::header('User-Agent'),
            'ip' => RequestFacade::ip(),
        ]);

        return back()->with('success', 'Berita berhasil dibagikan.');
    }
}