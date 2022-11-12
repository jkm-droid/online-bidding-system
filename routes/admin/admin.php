<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::get('admin/login', [AdminAuthController::class, 'adminShowLoginPage'])->name('show.login');
    Route::post('login', [AdminAuthController::class, 'signInAdmin'])->name('admin.login');
    Route::get('admin/register', [AdminAuthController::class, 'adminShowRegisterPage'])->name('show.register');
    Route::post('register', [AdminAuthController::class, 'createAdmin'])->name('admin.register');

    Route::middleware(['auth:admin'])->group(function (){
        Route::get('logout', [AdminAuthController::class, 'signOutAdmin'])->name('logout');

        Route::get('buyer-all-contributions', [DataController::class, 'showAllMemberContributions'])->name('contributions');
        Route::get('buyer-pending-contributions', [DataController::class, 'showPendingContributions'])->name('contributions.pending');
        Route::get('buyer-approved-contributions', [DataController::class, 'showApprovedContributions'])->name('contributions.approved');

        Route::put('approve-decline-contribution/{id}', [DataController::class, 'approveDeclineContribution'])->name('contributions.approve.decline');
        Route::post('import-contributions', [DataController::class, 'importContributions'])->name('import.contributions');

        Route::get('members', [DataController::class, 'getMembers'])->name('members');
        Route::get('members-approved', [DataController::class, 'getApprovedMembers'])->name('members.approved');
        Route::get('members-pending', [DataController::class, 'getPendingMembers'])->name('members.pending');
        Route::put('approve-buyer/{id}', [DataController::class, 'approveMember'])->name('buyer.approve');
    });

});

Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
