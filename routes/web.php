<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Business Card Routes
    Route::resource('cards', CardController::class)->except(['show']);
    Route::get('/cards/{card}/share', [CardController::class, 'share'])->name('cards.share');

    // User Orders History
    Route::get('/orders', function () {
        $orders = \App\Models\Order::where('email', Auth::user()->email)->latest()->get();
        return view('orders.index', compact('orders'));
    })->name('orders.index');
});

// Public Card Profiles (No login required)
Route::get('/cards/{card}/detail', [CardController::class, 'detail'])->name('cards.detail');
Route::get('/c/{slug}', [CardController::class, 'show'])->name('cards.public');

// Public Product & Knowledge Routes
Route::get('/san-pham/{slug}', [\App\Http\Controllers\PageController::class, 'showProduct'])->name('products.show');
Route::get('/kien-thuc/{slug}', [\App\Http\Controllers\PageController::class, 'showKnowledge'])->name('knowledge.show');

// Checkout Routes
Route::get('/cart', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Admin Routes
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle');
    
    Route::get('/cards', [AdminController::class, 'cards'])->name('cards');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
    Route::get('/users/export', [AdminController::class, 'exportUsers'])->name('users.export');
    Route::get('/cards/export', [AdminController::class, 'exportCards'])->name('cards.export');
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Products CRUD
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    // Knowledge CRUD
    Route::resource('knowledge', \App\Http\Controllers\Admin\KnowledgeController::class);

    // Order Management
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// Enterprise Routes
Route::middleware(['auth', 'enterprise'])->prefix('enterprise')->name('enterprise.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Enterprise\EnterpriseController::class, 'dashboard'])->name('dashboard');
    Route::resource('departments', \App\Http\Controllers\Enterprise\DepartmentController::class);
    Route::resource('employees', \App\Http\Controllers\Enterprise\EmployeeController::class);
    Route::get('/cards', [\App\Http\Controllers\Enterprise\EnterpriseController::class, 'cards'])->name('cards');
    Route::get('/statistics', [\App\Http\Controllers\Enterprise\EnterpriseController::class, 'statistics'])->name('statistics');
    Route::get('/settings', [\App\Http\Controllers\Enterprise\EnterpriseController::class, 'settings'])->name('settings');
    Route::put('/settings', [\App\Http\Controllers\Enterprise\EnterpriseController::class, 'updateSettings'])->name('settings.update');
});

require __DIR__.'/auth.php';
