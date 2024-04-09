<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdersExportController;
use App\Livewire\Admin\CardImages;
use App\Livewire\Admin\CardList;
use App\Livewire\Admin\CardPrice;
use App\Livewire\Admin\UserList;
use App\Livewire\Admin\OrderList as AdminOrderList;
use App\Livewire\NewOrder;
use App\Livewire\OrderDetail;
use App\Livewire\OrderList;
use Illuminate\Support\Facades\Route;

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

Route::get('/migrate', function () {
    Artisan::call('migrate');
});
Route::get('/storage_link', function () {
    Artisan::call('storage:link');
});
Route::get('/seed', function () {
    Artisan::call('db:seed');
});
Route::get('/seed/{class_name}', function ($class_name) {
    Artisan::call('db:seed ' . $class_name);
});

Route::get('/artisan/{cmd}', function ($cmd) {
    Artisan::call($cmd);
});

Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/check-payment-status', [DashboardController::class, 'checkPaymentStatus']);
// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

Route::get('order/new', NewOrder::class)->name('order.new');

Route::middleware([
    'auth',
])->group(function () {
    Route::view('profile', 'profile')->name('profile');
    Route::get('order/list', OrderList::class)->name('order.list');
    Route::get('order/details/{id}', OrderDetail::class)->name('order.detail');
});

Route::middleware([
    'auth',
    'role:admin',
])->prefix("admin")->group(function () {
    Route::get('user/list', UserList::class)->name('admin.user.list');
    Route::get('order/list', AdminOrderList::class)->name('admin.order.list');
    Route::get('card-imgs', CardImages::class)->name('admin.card.imgs');
    Route::get('card-price', CardPrice::class)->name('admin.card.price');
    Route::get('order/export', [OrdersExportController::class, 'export'])->name('admin.order.export');
});
require __DIR__.'/auth.php';
