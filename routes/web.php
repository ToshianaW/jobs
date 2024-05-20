<?php

use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function() {
    return Inertia::render('Index/Index');
})->name('home');

Route::get('/register', [UserRegistrationController::class, 'create']);
Route::post('/register', [UserRegistrationController::class, 'store']);