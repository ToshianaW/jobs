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
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');

Route::get('/register', [UserRegistrationController::class, 'create']);
Route::post('/register', [UserRegistrationController::class, 'store']);

Route::get('/login', [UserSessionController::class, 'create'])->name('login');
Route::post('/login', [UserSessionController::class, 'store']);

Route::post('/logout', [UserSessionController::class, 'destroy'])->name('logout');
