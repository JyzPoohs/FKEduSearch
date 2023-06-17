<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReportController;
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
    //user
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/profile/{id}', [UserController::class, 'profileView'])->name('user.profile-view');
    Route::post('/user/profile-update', [UserController::class, 'profileUpdate'])->name('user.profile-update');
    Route::get('/user/report', [UserController::class, 'report'])->name('user.report');

    //post
    Route::get('/post/close/{post}', [PostController::class, 'close'])->name('post.close');

    //complaint
    Route::get('/complaints/report', [ComplaintController::class, 'report'])->name('complaint.report');
    Route::get('/complaint/search', [ComplaintController::class, 'search'])->name('complaint.search');

    //expert
    Route::post('/expert/answer', [ExpertController::class, 'answerQuestion'])->name('expert.answer-question');
    Route::get('/expert/profile', [ExpertController::class, 'profile'])->name('expert.profile');
    Route::get('/expert/profile/{id}', [ExpertController::class, 'profileView'])->name('expert.profile-view');

    //others
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/form-example', [HomeController::class, 'formExample'])->name('form-example');
    // Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::resources([
        'user' => UserController::class,
        'complaint' => ComplaintController::class,
        'post' => PostController::class,
        'like' => LikeController::class,
        'comment' => CommentController::class,
        'report' => ReportController::class,
        'expert' => ExpertController::class,
        'feedback' => FeedbackController::class,
    ]);
});



URL::forceScheme('https');
