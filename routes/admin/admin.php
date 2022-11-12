<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageSellerController;
use App\Http\Controllers\Admin\ManageProductController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::get('admin/login', [AdminAuthController::class, 'adminShowLoginPage'])->name('show.login');
    Route::post('login', [AdminAuthController::class, 'signInAdmin'])->name('admin.login');
    Route::get('admin/register', [AdminAuthController::class, 'adminShowRegisterPage'])->name('show.register');
    Route::post('register', [AdminAuthController::class, 'createAdmin'])->name('admin.register');

    Route::middleware(['auth:admin'])->group(function (){
        Route::get('logout', [AdminAuthController::class, 'signOutAdmin'])->name('logout');

        Route::get('sellers', [ManageSellerController::class, 'getSellers'])->name('seller');
        Route::get('seller/create', [ManageSellerController::class, 'addNewSellerForm'])->name('seller.add.form');
        Route::post('seller-create', [ManageSellerController::class, 'addNewSeller'])->name('seller.add');
        Route::get('seller/edit/{seller_id}', [ManageSellerController::class, 'editSellerForm'])->name('seller.edit.form');
        Route::put('seller-edit/{seller_id}', [ManageSellerController::class, 'editSeller'])->name('seller.edit');

        Route::get('products', [ManageProductController::class, 'getProducts'])->name('product');
        Route::get('product/create', [ManageProductController::class, 'addNewProductForm'])->name('product.add.form');
        Route::post('product-create', [ManageProductController::class, 'addNewProduct'])->name('product.add');
        Route::get('product/edit/{product_id}', [ManageProductController::class, 'editProductForm'])->name('product.edit.form');
        Route::put('product-edit/{product_id}', [ManageProductController::class, 'editProduct'])->name('product.edit');

    });

});

Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
