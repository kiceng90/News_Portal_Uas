<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\NewsVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VisitController extends Controller
{
    public function index()
    {
        // Ganti get() menjadi paginate()
        $visits = NewsVisit::with('news')->latest()->paginate(10);
        return view('staff.visits.index', compact('visits'));
    }

    // Hapus data kunjungan (opsional)
    public function destroy(NewsVisit $visit): RedirectResponse
    {
        $visit->delete();
        return back()->with('success', 'Kunjungan berhasil dihapus.');
    }
}
