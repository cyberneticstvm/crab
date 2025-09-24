<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\CrabController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::middleware(['web'])->group(function () {
    Route::prefix('')->controller(AuthController::class)->group(function () {
        Route::post('/', 'login')->name('user.login');
    });
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::prefix('')->controller(CrabController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::prefix('member')->controller(MemberController::class)->group(function () {
        Route::get('register/{type}', 'index')->name('member.register');
        Route::get('create/{type}', 'create')->name('member.create');
        Route::post('create/{type}', 'store')->name('member.save');
        Route::get('edit/{id}', 'edit')->name('member.edit');
        Route::post('edit/{id}', 'update')->name('member.update');
        Route::get('delete/{id}', 'destroy')->name('member.delete');
    });

    Route::prefix('contribution')->controller(ContributionController::class)->group(function () {
        Route::get('register', 'index')->name('contribution.register');
        Route::get('create', 'create')->name('contribution.create');
        Route::post('create', 'store')->name('contribution.save');
        Route::get('edit/{id}', 'edit')->name('contribution.edit');
        Route::post('edit/{id}', 'update')->name('contribution.update');
        Route::get('delete/{id}', 'destroy')->name('contribution.delete');
    });

    Route::prefix('pdf')->controller(PdfController::class)->group(function () {
        Route::get('contribution/receipt/{id}', 'contributionReceipt')->name('contribution.receipt');
    });
});
