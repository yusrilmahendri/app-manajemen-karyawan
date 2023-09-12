<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DataController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DataController::class)->group(function () {
    Route::get('/api/order', 'order')->name('order.api');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/api/order/users/{id}', 'data')->name('admin.api.users');
    Route::get('/api/user/orders/{id}', 'datas')->name('admin.api.users.order');
    Route::get('/orders', 'index')->name('orders');
    Route::get('/order', 'create')->name('order.create');
    Route::post('/order', 'store')->name('order.store');
    Route::get('/order/{id}', 'edit')->name('order.edit');
    Route::put('/order/{id}', 'update')->name('order.update');
    Route::delete('/order/{id}/delete', 'destroy')->name('order.destroy');
});
