<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecryptController;

use App\Http\Controllers\DeviceController;
// use App\Http\Controllers\DoorLockController;
use App\Http\Controllers\UserLogController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\UserCardController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\MqttController;

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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/decrypt', [DecryptController::class, 'decryptCiphertext'])->name('decrypt');
Route::view('/decrypted', 'decrypted')->name('decrypted');


/**
 * Rute Dashboard
 */

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [UserLogController::class, 'dashboard']);
});

/**
 * Rute untuk role admin
 */
Route::group(['middleware' => ['auth', 'can:isAdmin']], function () {
    Route::get('/dashboard/userlog', [UserLogController::class, 'index']);
    Route::get('/dashboard/userlog/export', [UserLogController::class, 'export']);
    Route::delete('/dashboard/userlog/clear-record', [UserLogController::class, 'clearRecord']);
    Route::resource('/dashboard/device', DeviceController::class);
    Route::resource('/dashboard/user-card', UserCardController::class);
    Route::resource('/dashboard/user-info', UserInfoController::class);
    Route::resource('/admin/users', UserController::class);
});


/**
 * Route untuk role staff
 */
Route::group(['middleware' => ['auth', 'can:isStaff']], function () {
    Route::get('/dashboard/userinfo', [UserInfoController::class, 'anyIndex']);
    Route::get('/dashboard/anyshow/{userInfo}', [UserInfoController::class, 'anyShow']);
});

/**
 * Rute Absen
 */
// Route::get('/doorlock/get', [DoorLockController::class, 'doorlock']);

/** 
 * Rute Registrasi dan login
 */
Route::get('/register', [RegisterUserController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterUserController::class, 'store']);
Route::get('/login', [LoginUserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginUserController::class, 'authenticate']);
Route::post('/logout', [LoginUserController::class, 'logout']);

Route::get('/mqtt-subscribe', [MqttController::class, 'publishMessage']);
