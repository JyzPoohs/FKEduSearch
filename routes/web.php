<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\URL;

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


Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile-update', [UserController::class, 'profileUpdate'])->name('user.profile-update');
    Route::resource('user', UserController::class);
    Route::resource('post', PostController::class);
    Route::resource('like', LikeController::class);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/form-example', [HomeController::class, 'formExample'])->name('form-example');
    Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

URL::forceScheme('https');
