<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsShare;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index()
    {
        $shares = NewsShare::with('news')->get();
        return view('admin.shares.index', compact('shares'));
    }
}
