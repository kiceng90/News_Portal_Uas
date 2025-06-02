<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'staff') {
                return redirect()->intended(route('staff.dashboard'));
            }

            // Jika client → arahkan ke halaman utama berita
            return redirect()->intended(route('news.index'));
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak cocok dengan data kami.',
        ]);
    }
}
