<?php

use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PlaceTakeoffController;

use App\Http\Middleware\AdminMiddleware;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // User CRUD routes
    Route::resource('users', UserController::class);
});


// Project routes (accessible by both admin and estimator)
Route::middleware(['auth', \App\Http\Middleware\ProjectAccessMiddleware::class])
    ->prefix('projects')
    ->name('projects.')
    ->group(function () {
        Route::resource('/', ProjectController::class)
            ->parameter('', 'project'); // Maps the empty parameter name to 'project'
    });

    Route::middleware(['auth', \App\Http\Middleware\ProjectAccessMiddleware::class])
    ->prefix('projects')
    ->name('projects.')
    ->group(function () {
        // Place Takeoff routes (simplified)
        Route::get('{project}/takeoffs/create', [PlaceTakeoffController::class, 'create'])->name('takeoffs.create');
        Route::post('{project}/takeoffs', [PlaceTakeoffController::class, 'store'])->name('takeoffs.store');
        Route::get('{project}/takeoffs', [PlaceTakeoffController::class, 'show'])->name('takeoffs.show');
        Route::delete('{project}/takeoffs', [PlaceTakeoffController::class, 'destroy'])->name('takeoffs.destroy');
    });


    Route::middleware(['auth'])->group(function () {
        Route::get('/projects/{project}/sinks', [App\Http\Controllers\SinksController::class, 'index'])->name('projects.sinks.index');
        Route::get('/projects/{project}/sinks/create', [App\Http\Controllers\SinksController::class, 'create'])->name('projects.sinks.create');
        Route::post('/projects/{project}/sinks', [App\Http\Controllers\SinksController::class, 'store'])->name('projects.sinks.store');
        Route::get('/projects/{project}/sinks/{sink}/edit', [App\Http\Controllers\SinksController::class, 'edit'])->name('projects.sinks.edit');
        Route::put('/projects/{project}/sinks/{sink}', [App\Http\Controllers\SinksController::class, 'update'])->name('projects.sinks.update');
        Route::delete('/projects/{project}/sinks/{sink}', [App\Http\Controllers\SinksController::class, 'destroy_single'])->name('projects.sinks.destroy_single');
        Route::delete('/projects/{project}/sinks', [App\Http\Controllers\SinksController::class, 'destroy'])->name('projects.sinks.destroy');
    });

require __DIR__.'/auth.php';
