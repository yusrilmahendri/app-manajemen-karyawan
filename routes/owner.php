<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\UserController;
use App\Http\Controllers\Owner\DataController;
use App\Http\Controllers\Owner\SettingController;
use App\Http\Controllers\Owner\RecordController;
use App\Http\Controllers\Owner\SettingAdminController;


/*
|--------------------------------------------------------------------------
| consumer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(DataController::class)->group(function() {
    Route::get('/pengguna/api', 'users')->name('api.pengguna');
    Route::get('/admin/api', 'admin')->name('api.setting.admin');
    Route::get('/api/record', 'record')->name('api.record');
    Route::get('/generateRecordPdf', 'generatePdfRecord')->name('generateRecordPdf');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/users', 'index')->name('users');
    Route::get('/user', 'create')->name('user');
    Route::post('/user/create', 'store')->name('user.create');
    Route::get('/user/{id}', 'show')->name('user.show');
    Route::get('/user/{id}/edit', 'edit')->name('user.edit');
    Route::put('/user/{id}', 'update')->name('user.update');
    Route::delete('/user/{id}', 'destroy')->name('user.destroy');
});

Route::controller(SettingController::class)->group(function (){
    Route::get('/setting', 'index')->name('setting');
    Route::put('/setting/password/{id}', 'updatePassword')->name('setting.passwords'); 
    Route::put('/setting/profile/{id}', 'update')->name('setting.profile'); 
});

Route::controller(SettingAdminController::class)->group(function(){
    Route::get('/setting/admin', 'index')->name('setting.admin');
    Route::get('/setting/admin/{id}', 'show')->name('information.admin');
    Route::get('/setting/{id}/edit', 'edit')->name('admin.edit');
    Route::put('/setting/admin/{id}', 'update')->name('admin.update');
});

Route::controller(RecordController::class)->group(function(){
    Route::get('record-users', 'index')->name('record');
});