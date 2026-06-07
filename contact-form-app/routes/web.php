<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminTagController;


Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contacts/back', [ContactController::class, 'back'])->name('contact.back');
Route::post('/contacts/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');


// Breeze のユーザー用
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 管理者認証
|--------------------------------------------------------------------------
*/

Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.post');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| 管理者専用ページ（ログイン必須）
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    // お問い合わせ一覧・詳細
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('admin.contacts.show');

    // タグ管理
    Route::post('/tags', [AdminTagController::class, 'store'])->name('admin.tags.store');
    Route::get('/tags/{tag}/edit', [AdminTagController::class, 'edit'])->name('admin.tags.edit');
    Route::put('/tags/{tag}', [AdminTagController::class, 'update'])->name('admin.tags.update');
    Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy'])->name('admin.tags.destroy');
});


