<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\NewsComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = NewsComment::with(['news', 'user'])->get();
        return view('staff.comments.index', compact('comments'));
    }

    public function destroy($id)
    {
        $comment = NewsComment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
