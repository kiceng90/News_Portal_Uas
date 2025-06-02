<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\NewsVisit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $visits = NewsVisit::with('news')->get();
        return view('staff.visits.index', compact('visits'));
    }
}
