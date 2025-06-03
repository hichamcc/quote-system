<?php

use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PlaceTakeoffController;
use App\Http\Controllers\PricingFactorController;
use App\Http\Controllers\AddonController;
use App\Http\Controllers\AreaTypeController;
use App\Http\Controllers\MaterialController;

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
        Route::put('{project}/takeoffs/{takeoff}', [PlaceTakeoffController::class, 'update'])->name('takeoffs.update');

        Route::get('{project}/takeoffs', [PlaceTakeoffController::class, 'show'])->name('takeoffs.show');
        Route::delete('{project}/takeoffs', [PlaceTakeoffController::class, 'destroy'])->name('takeoffs.destroy');
        Route::get('{project}/takeoffs/{takeoff}/edit', [PlaceTakeoffController::class, 'edit'])->name('takeoffs.edit');
        Route::delete('{project}/takeoffs/{takeoff}', [PlaceTakeoffController::class, 'destroy_single'])
        ->name('takeoffs.destroy_single');
    
    });


    Route::middleware(['auth'])->group(function () {
        Route::get('/projects/{project}/sinks', [App\Http\Controllers\SinksController::class, 'index'])->name('projects.sinks.index');
        Route::get('/projects/{project}/sinks/create', [App\Http\Controllers\SinksController::class, 'create'])->name('projects.sinks.create');
        Route::post('/projects/{project}/sinks', [App\Http\Controllers\SinksController::class, 'store'])->name('projects.sinks.store');
        Route::get('/projects/{project}/sinks/{sink}/edit', [App\Http\Controllers\SinksController::class, 'edit'])->name('projects.sinks.edit');
        Route::put('/projects/{project}/sinks/{sink}', [App\Http\Controllers\SinksController::class, 'update'])->name('projects.sinks.update');
        Route::delete('/projects/{project}/sinks/{sink}', [App\Http\Controllers\SinksController::class, 'destroy_single'])->name('projects.sinks.destroy_single');
        Route::delete('/projects/{project}/sinks', [App\Http\Controllers\SinksController::class, 'destroy'])->name('projects.sinks.destroy');
   
        // Project summary routes
        Route::get('/projects/{project}/summary-content', [App\Http\Controllers\ProjectController::class, 'summaryContent'])
            ->name('projects.summary-content');
        Route::get('/projects/{project}/print-summary', [App\Http\Controllers\ProjectController::class, 'printSummary'])
            ->name('projects.print-summary');

        Route::get('/projects/{id}/generate-pdf', [ProjectController::class, 'generatePdf'])->name('project.generate-pdf');


        // Addon routes nested under projects
        Route::prefix('projects/{project}')->name('projects.')->group(function () {
            Route::resource('addons', AddonController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
            
            // Custom nested resource routes for addons
            Route::get('/addons', [AddonController::class, 'index'])->name('addons.index');
            Route::get('/addons/create', [AddonController::class, 'create'])->name('addons.create');
            Route::post('/addons', [AddonController::class, 'store'])->name('addons.store');
            Route::get('/addons/{addon}', [AddonController::class, 'show'])->name('addons.show');
            Route::get('/addons/{addon}/edit', [AddonController::class, 'edit'])->name('addons.edit');
            Route::put('/addons/{addon}', [AddonController::class, 'update'])->name('addons.update');
            Route::delete('/addons/{addon}', [AddonController::class, 'destroy'])->name('addons.destroy');
        });

    });

    Route::middleware(['auth'])->group(function () {
        Route::get('pricing-factors', [PricingFactorController::class, 'index'])->name('pricing-factors.index');
        Route::get('pricing-factors/edit', [PricingFactorController::class, 'edit'])->name('pricing-factors.edit');
        Route::put('pricing-factors', [PricingFactorController::class, 'update'])->name('pricing-factors.update');
        
        // Edge Types management within pricing factors
        Route::post('pricing-factors/edge-types', [PricingFactorController::class, 'storeEdgeType'])->name('pricing-factors.edge-types.store');
        Route::put('pricing-factors/edge-types/{edgeType}', [PricingFactorController::class, 'updateEdgeType'])->name('pricing-factors.edge-types.update');
        Route::delete('pricing-factors/edge-types/{edgeType}', [PricingFactorController::class, 'destroyEdgeType'])->name('pricing-factors.edge-types.destroy');
    
    });


    // Area Types routes (separate page)
        Route::middleware(['auth'])->group(function () {
            Route::get('area-types', [AreaTypeController::class, 'index'])->name('area-types.index');
            Route::post('area-types', [AreaTypeController::class, 'store'])->name('area-types.store');
            Route::put('area-types/{areaType}', [AreaTypeController::class, 'update'])->name('area-types.update');
            Route::delete('area-types/{areaType}', [AreaTypeController::class, 'destroy'])->name('area-types.destroy');
        });

        // Materials routes
        Route::middleware(['auth'])->group(function () {
            Route::get('materials', [MaterialController::class, 'index'])->name('materials.index');
            Route::post('materials', [MaterialController::class, 'store'])->name('materials.store');
            Route::put('materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
            Route::delete('materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
        });

        

            // Route to generate a share token
        Route::post('/projects/{id}/share', [ProjectController::class, 'generateShareLink'])->name('project.generate-share-link');

        // Public routes that don't require authentication
        Route::prefix('shared')->name('shared.')->group(function () {
            // View the project summary with a share token
            Route::get('/summary/{token}', [ProjectController::class, 'publicSummary'])->name('summary');
            
            // Generate a PDF from the public summary
            Route::get('/summary/{token}/pdf', [ProjectController::class, 'publicGeneratePdf'])->name('generate-pdf');
        });

require __DIR__.'/auth.php';
