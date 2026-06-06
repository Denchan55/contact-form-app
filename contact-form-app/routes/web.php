<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminAuthController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'adminShow'])->name('admin.contacts.show');
});

// 管理者登録画面
Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])
    ->name('admin.register');

// 管理者登録処理
Route::post('/admin/register', [AdminAuthController::class, 'register'])
    ->name('admin.register.post');

// 管理者ログイン画面
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

// 管理者ログイン処理
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.post');

// 管理者ログアウト
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

// 管理者専用ページ（ログイン必須）
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/contacts', [ContactController::class, 'adminIndex'])
        ->name('admin.contacts.index');
});