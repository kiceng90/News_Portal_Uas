<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('staff.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        $countries = Country::all();
        return view('staff.news.create', compact('categories', 'countries'));
    }

    public function store(Request $request)
    {
        // Tampilkan semua input untuk debug
        // dd($request->all());

        $validated = $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'content' => 'required',
            'author' => 'required',
            'slug' => 'required|unique:news,slug',
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
        }

        News::create([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'author' => $request->author,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'country_id' => $request->country_id,
            'image' => $imageName
        ]);

        return redirect()->route('staff.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil data berita beserta relasi kategori dan negara
        $news = News::with(['category', 'country'])->findOrFail($id);

        // Ambil semua kategori & negara untuk dropdown
        $categories = Category::all();
        $countries = Country::all();

        // Kirim data ke view
        return view('staff.news.edit', compact('news', 'categories', 'countries'));
    }

    public function update(Request $request, $id)
    {
        // Ambil berita berdasarkan ID
        $news = News::findOrFail($id);

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string',
            'slug' => 'required|alpha_dash|unique:news,slug,'.$id,
            'category_id' => 'required|exists:categories,id',
            'country_id' => 'required|exists:countries,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update data berita tanpa gambar dulu
        $news->title = $request->input('title');
        $news->short_desc = $request->input('short_desc');
        $news->content = $request->input('content');
        $news->author = $request->input('author');
        $news->slug = $request->input('slug');
        $news->category_id = $request->input('category_id');
        $news->country_id = $request->input('country_id');

        // Jika ada upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image && file_exists(public_path('images/'.$news->image))) {
                unlink(public_path('images/'.$news->image));
            }

            // Simpan gambar baru
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $news->image = $imageName;
        }

        // Simpan perubahan
        $news->save();

        // Redirect ke halaman staff news index
        return redirect()->route('staff.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image && file_exists(public_path('images/'.$news->image))) {
            unlink(public_path('images/'.$news->image));
        }
        $news->delete();

        return redirect()->route('staff.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
