<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Staff;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend News (Public)
Route::get('/', function () {
    return redirect()->route('news.index');
});

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
// Route::get('/news/{id}/share', [NewsController::class, 'storeShare'])->name('news.share');

// Simpan komentar – HARUS DI LUAR GROUP ROLE SPECIFIC
Route::middleware(['auth'])->group(function () {
    Route::post('/news/{id}/comment', [NewsController::class, 'storeComment'])->name('news.comment.store');
    Route::get('/news/{id}/share', [NewsController::class, 'storeShare'])->name('news.share');
});

// Dashboard Default (untuk client)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'staff') {
            return redirect()->route('staff.dashboard');
        }

        return view('dashboard');
    })->name('dashboard');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::resource('news', Admin\NewsController::class);
    Route::resource('categories', Admin\CategoryController::class);
    Route::resource('countries', Admin\CountryController::class);
    Route::resource('comments', Admin\CommentController::class)->only(['index', 'destroy']);
    Route::resource('visits', Admin\VisitController::class)->only(['index', 'destroy']);
    Route::resource('shares', Admin\ShareController::class)->only(['index', 'destroy']);
});

// Staff Routes 
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', fn() => view('staff.dashboard'))->name('dashboard');
    Route::resource('news', Staff\NewsController::class);
    Route::resource('categories', Staff\CategoryController::class);
    Route::resource('countries', Staff\CountryController::class);
    Route::resource('comments', Staff\CommentController::class)->only(['index', 'destroy']);
    Route::resource('visits', Staff\VisitController::class)->only(['index', 'destroy']);
    Route::resource('shares', Staff\ShareController::class)->only(['index', 'destroy']);
});

// Client Routes
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', fn() => view('client.dashboard'))->name('dashboard');
});

require __DIR__.'/auth.php';



