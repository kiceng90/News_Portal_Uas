<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsVisit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $visits = NewsVisit::with('news')->get();
        return view('admin.visits.index', compact('visits'));
    }
}
