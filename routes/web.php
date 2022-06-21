<?php

use App\Http\Livewire\Dashboard\Home;
use App\Http\Livewire\Dashboard\Invoice;
use App\Http\Livewire\Dashboard\Invoices;
use App\Http\Livewire\Dashboard\Products;
use App\Http\Livewire\Dashboard\Purchase;
use App\Http\Livewire\Dashboard\Purchases;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::name('dashboard.')->prefix('/dashboard')->group(function () {
        Route::get('/home', Home::class)->name('home');

        Route::middleware(['auth.admin'])->group(function () {
            Route::get('/purchases', Purchases::class)->name('purchases');
            Route::get('/invoices', Invoices::class)->name('invoices');
            Route::get('/invoices/{invoice}', Invoice::class)->name('invoice');
            Route::get('/products', Products::class)->name('products');
        });

        Route::middleware(['auth.client'])->group(function () {
            Route::get('/purchase', Purchase::class)->name('purchase');
        });
    });
});
