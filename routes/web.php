<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SignController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::controller(NoteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/archive', 'archivePage')->name('archive');

        Route::prefix('/note/{note}')
            ->name('note.')
            ->group(function () {
                Route::patch('/favorite', 'favorite')->name('favorite');
                Route::patch('/archive', 'archive')->name('archive');
            });
    });

    Route::resource('note', NoteController::class)->except(['index']);

    Route::controller(SettingsController::class)
        ->name('settings.')
        ->group(function () {
            Route::get('/settings', 'index')->name('index');
        });
});

Route::controller(SignController::class)
    ->name('auth.')
    ->group(function () {
        Route::middleware('preventAuthUser')->group(function () {
            Route::get('/sign-in', 'renderSignInPage')->name('signinPage');
            Route::get('/login', 'renderLoginPage')->name('loginPage');

            Route::post('/sign-in', 'signIn')->name('signin');
            Route::post('/login', 'login')->name('login');
        });

        Route::post('/logout', 'logout')->name('logout');
    });

