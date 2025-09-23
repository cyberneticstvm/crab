<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrabController;
use App\Http\Controllers\DonationController;
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

    Route::prefix('donation')->controller(DonationController::class)->group(function () {
        Route::get('register', 'index')->name('donation.register');
        Route::get('create', 'create')->name('donation.create');
        Route::post('create', 'store')->name('donation.save');
        Route::get('edit/{id}', 'edit')->name('donation.edit');
        Route::post('edit/{id}', 'update')->name('donation.update');
        Route::get('delete/{id}', 'destroy')->name('donation.delete');
    });

    Route::prefix('pdf')->controller(PdfController::class)->group(function () {
        Route::get('donation/receipt/{id}', 'donationReceipt')->name('donation.receipt');
    });
});
