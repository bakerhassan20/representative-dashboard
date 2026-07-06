<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\DailyReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\AdminDailyReportController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| HOME REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/report', [DailyReportController::class, 'create'])->name('daily-report.create');
Route::get('/report/client-info', [DailyReportController::class, 'getClientInfo'])->name('daily-report.client-info');
Route::post('/report', [DailyReportController::class, 'store'])->name('daily-report.store');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::put('/password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');

    /*
    |--------------------------------------------------------------------------
    | DAILY REPORTS (ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/daily-reports')->name('admin.daily-reports.')->group(function () {
        Route::get('/', [AdminDailyReportController::class, 'index'])->name('index');
        Route::post('/bulk-action', [AdminDailyReportController::class, 'bulkAction'])->name('bulk');
        Route::get('/{id}', [AdminDailyReportController::class, 'show'])->name('show');
        Route::put('/{id}/status', [AdminDailyReportController::class, 'updateStatus'])->name('status');
        Route::put('/{id}/resubmit', [AdminDailyReportController::class, 'toggleResubmit'])->name('resubmit');
        Route::delete('/{id}', [AdminDailyReportController::class, 'destroy'])->name('destroy');
    });
    /*
    |--------------------------------------------------------------------------
    | CLIENTS MODULE
    |--------------------------------------------------------------------------
    */

    Route::resource('clients', ClientController::class)
    ->except(['show']);

    Route::get('clients-trashed', [ClientController::class, 'trashed'])
        ->name('clients.trashed');

    Route::post('clients-restore/{id}', [ClientController::class, 'restore'])
        ->name('clients.restore');


   // city routes
    Route::resource('cities', CityController::class)
    ->except(['show']);









    /*
    |--------------------------------------------------------------------------
    | USERS MODULE
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | ROLES & PERMISSIONS MODULE
    |--------------------------------------------------------------------------
    */

    Route::resource('roles', RoleController::class);

    /*
    |--------------------------------------------------------------------------
    | SETTINGS MODULE
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings');

    Route::post('/settings', [SettingController::class, 'update'])
        ->name('settings.update');
});
