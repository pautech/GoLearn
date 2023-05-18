<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleSocialiteController;

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
    return view('welcome'); 
});
Route::get('/about', function () {
    return view('about'); 
});
Route::get('/courses', function () {
    return view('courses'); 
});
Route::get('/contact', function () {
    return view('contact'); 
});

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);  // redirect to google login
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);    // callback route after google account chosen


Route::get('auth/github', [GoogleSocialiteController::class, 'redirectToGithub']);  // redirect to github login
Route::get('callback/github', [GoogleSocialiteController::class, 'githubCallback']);    // callback route after github account chosen


Route::get('auth/facebook', [GoogleSocialiteController::class, 'redirectTofacebook']);  // redirect to facebook login
Route::get('callback/facebook', [GoogleSocialiteController::class, 'facebookCallback']);    // callback route after facebook account chosen



Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
 
    // $user->token
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
