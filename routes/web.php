<?php

use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\UserSessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ListingController;

Route::get('/', function() {
    return Inertia::render('Index/Index');
})->name('home')->middleware('auth');

Route::get('/about', function() {
    return Inertia::render('Index/About');
})->name('about')->middleware('auth');


Route::get('/listings', [ListingController::class, 'index'])->name('index.listings');

Route::get('/register', [UserRegistrationController::class, 'create']);
Route::post('/register', [UserRegistrationController::class, 'store']);

Route::get('/login', [UserSessionController::class, 'create'])->name('login');
Route::post('/login', [UserSessionController::class, 'store']);

Route::post('/logout', [UserSessionController::class, 'destroy'])->name('logout');
