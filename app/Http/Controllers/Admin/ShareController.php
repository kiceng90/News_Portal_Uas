<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsShare;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index()
    {
        $shares = NewsShare::with(['news', 'user'])->latest()->paginate(10);
        return view('admin.shares.index', compact('shares'));
    }

    public function destroy(NewsShare $share)
    {
        $share->delete();
        return back()->with('success', 'Data share berhasil dihapus.');
    }
}
