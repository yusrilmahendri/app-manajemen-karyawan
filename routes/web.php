<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::controller(LoginController::class)->group(function(){
    Route::get('/', 'index')->name('homepage');
    Route::get('/login', 'index')->name('auth.login');
    Route::post('/login', 'authentication')->name('login');
    Route::get('/logout', 'logout')->name('logout');
});



