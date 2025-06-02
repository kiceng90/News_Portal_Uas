<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\NewsComment;
use App\Models\NewsVisit;

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
    public function show(Request $request, $id)
    {
        $news = News::with(['category', 'country'])->findOrFail($id);

        // Ambil semua komentar utama + reply
        $comments = NewsComment::where('news_id', $id)
                                ->whereNull('parent_id')
                                ->with(['user', 'replies.user'])
                                ->get();

        return view('news.show', compact('news', 'comments'));
    }

    // public function show($id)
    // {
    //     $news = News::with(['category', 'country'])->findOrFail($id);

    //     // Simpan kunjungan
    //     NewsVisit::create([
    //         'news_id' => $id,
    //         'ip' => Request::ip(),
    //         'user_agent' => Request::header('User-Agent'),
    //         'referer' => Request::header('Referer'),
    //         'browser' => $this->getBrowser(Request::header('User-Agent')),
    //         'platform' => php_uname('s'), // atau gunakan request()->server('HTTP_USER_AGENT') untuk lebih akurat
    //         'visited_at' => now()
    //     ]);

    //     $comments = NewsComment::whereNull('parent_id')->where('news_id', $id)->with(['replies.user', 'user'])->get();

    //     return view('news.show', compact('news', 'comments'));
    // }

    // Simpan komentar
    public function storeComment(Request $request, $newsId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:news_comments,id'
        ]);

        NewsComment::create([
            'news_id' => $newsId,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'parent_id' => $request->input('parent_id') ?: null
        ]);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }

    private function getBrowser($userAgent)
    {
        if (str_contains($userAgent, 'Firefox')) return 'Firefox';
        elseif (str_contains($userAgent, 'Chrome')) return 'Chrome';
        elseif (str_contains($userAgent, 'Safari')) return 'Safari';
        elseif (str_contains($userAgent, 'MSIE')) return 'Internet Explorer';
        else return 'Unknown';
    }
}
