<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// ─── Customer Routes ─────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category.show');
Route::get('/product/{product}', [HomeController::class, 'product'])->name('product.show');
Route::get('/compare', [HomeController::class, 'compare'])->name('compare');
Route::get('/about', fn() => view('customer.about'))->name('about');
Route::get('/faq',   fn() => view('customer.faq'))->name('faq');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::get('/matcher', [HomeController::class, 'matcher'])->name('matcher');

// Customer Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Secret Staff Route
Route::get('/staff-login', [AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');


// ─── Auth Routes (built-in Laravel Breeze/Jetstream or manual) ───────────────
require __DIR__.'/auth.php';



// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/interactions', [DashboardController::class, 'interactions'])->name('interactions');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
});

