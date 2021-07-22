<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/rooms', [DashboardController::class, 'getRooms']);
Route::get('/dashboard/create_room', [DashboardController::class, 'createRoom']);


Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
