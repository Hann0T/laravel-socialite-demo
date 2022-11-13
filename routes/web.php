<?php

use App\Http\Controllers\SocialiteController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return 'no current login view';
})->name('login');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->get('/dashboard', function () {
    return auth()->user();
});


Route::get('/auth/github/redirect', [SocialiteController::class, 'redirectGithub']);
Route::get('/auth/github/callback', [SocialiteController::class, 'callbackGithub']);

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectGoogle']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callbackGoogle']);
