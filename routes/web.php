<?php

use App\Http\Controllers\QueryRolesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Users
    Route::resource('users', UsersController::class)->except(['show', 'destroy']);
    Route::patch('users/{user}/inactivate', [UsersController::class, 'inactivate'])->name('users.inactivate');
    Route::patch('users/{user}/activate', [UsersController::class, 'activate'])->name('users.activate');

    // Roles
    Route::resource('/roles', RolesController::class)->except('show');
    Route::get('/roles/query', QueryRolesController::class)->name('roles.query');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
