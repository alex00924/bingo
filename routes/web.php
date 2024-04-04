<?php

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

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

Route::middleware([
    'auth',
])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
    Route::get('order/list', OrderList::class)->name('order.list');
    Route::get('order/new', NewOrder::class)->name('order.new');
    Route::get('order/details/{id}', OrderDetail::class)->name('order.detail');
});
require __DIR__.'/auth.php';
