<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(GalleryController::class)->group(function () {
    Route::get('galleries', 'index');
    Route::post('galleries', 'store')->middleware('auth');
    Route::get('galleries/{gallery}', 'show');
    Route::put('galleries/{gallery}', 'update')->middleware('auth');
    Route::delete('galleries/{gallery}', 'destroy')->middleware('auth');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('comments', 'store')->middleware('auth');
    Route::delete('comments/{comment}', 'destroy')->middleware('auth');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth');
    Route::get('profile', 'getMyProfile')->middleware('auth');
});

