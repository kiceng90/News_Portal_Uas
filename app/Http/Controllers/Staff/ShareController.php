<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\NewsShare;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index()
    {
        $shares = NewsShare::with('news')->get();
        return view('staff.shares.index', compact('shares'));
    }
}
