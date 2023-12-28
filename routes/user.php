<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DataController;

/*
|--------------------------------------------------------------------------
| user routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DataController::class)->group(function(){
    Route::get('api/todo', 'todo')->name('api.todo');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/todos', 'index')->name('todo');
    Route::get('/todo/{id}', 'show')->name('todo.show');
    Route::get('settings', 'setting')->name('settings');
    Route::put('/orders/{order}/complete', 'completeOrder')->name('orders.complete');
});
