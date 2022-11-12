<?php

use App\Http\Controllers\Buyer\AuthController;
use App\Http\Controllers\Buyer\PortalController;
use App\Http\Controllers\Buyer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::name('buyer.')->group(function (){
    Route::get('buyer/login', [AuthController::class, 'showLoginPage'])->name('show.login');
    Route::post('buyer-login', [AuthController::class, 'loginBuyer'])->name('login');
    Route::get('buyer/register', [AuthController::class, 'showRegisterPage'])->name('show.register');
    Route::post('buyer-register', [AuthController::class, 'registerBuyer'])->name('register');
    Route::get('buyer-logout', [AuthController::class, 'logoutBuyer'])->name('logout');

    //resetting password
    Route::get('buyer/forgot_pass', [AuthController::class, 'showForgotPassForm'])->name('show.forgot_pass_form');
    Route::post('forgot_pass', [AuthController::class, 'submitForgotPassForm'])->name('forgot_submit');
    Route::get('buyer/reset_pass/{token}', [AuthController::class, 'showResetPassForm'])->name('show.reset_form');
    Route::post('reset_pass', [AuthController::class, 'resetPass'])->name('reset_pass');

    //email verification
    Route::get('account/verify/{token}', [AuthController::class, 'verifyBuyerEmail'])->name('verify.email');

    Route::get('portal', [PortalController::class, 'showPortalDashboard'])->name('portal');

    Route::get('buyer/profile', [ProfileController::class, 'showProfilePage'])->name('profile.view');
    Route::get('buyer/profile/edit', [ProfileController::class, 'showProfileEditPage'])->name('profile.edit');
    Route::put('buyer/profile/update/{id}', [ProfileController::class, 'updateBuyerProfile'])->name('profile.update');
});
