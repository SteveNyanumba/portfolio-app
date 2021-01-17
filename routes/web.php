<?php

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

Route::redirect('/dashboard', '/user/dashboard', 301);
Route::redirect('/admin', '/user/dashboard', 301);



Route::group(['prefix' => '/user'], function () {
    // Dashboard Route
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    //Portfolios Routes
    Route::middleware(['auth:sanctum', 'verified'])->get('/portfolio', function () {
        return Inertia\Inertia::render('Portfolio');
    })->name('portfolio');

    //Blogs Routes
    Route::middleware(['auth:sanctum', 'verified'])->get('/blog', function () {
        return Inertia\Inertia::render('Blog');
    })->name('blog');
});
