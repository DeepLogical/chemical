<?php

use Illuminate\Support\Facades\Route;

use Deep\Admin\Http\Livewire\Admin\AdminUsers;
use Deep\Admin\Http\Livewire\Admin\AdminSpatie;
use Deep\Admin\Http\Livewire\Admin\AdminSetting;
use Deep\Admin\Http\Livewire\Admin\AdminDashboard;
use Deep\Admin\Http\Livewire\Admin\AdminWalletRechargeHistory;

use Deep\Admin\Http\Livewire\User\UserSpatie;
use Deep\Admin\Http\Livewire\User\MyStaffList;
use Deep\Admin\Http\Livewire\User\Notifications;
use Deep\Admin\Http\Livewire\User\ProfileImage;
use Deep\Admin\Http\Livewire\User\WalletRechargeHistory;

Route::middleware(['web'])->group(function () {
        Route::middleware(['auth:sanctum', 'verified'])->group(function () {
            Route::get('profile-image', ProfileImage::class)->name('profileImage');
            // Route::get("my-wallet", WalletRechargeHistory::class)->name('walletRechargeHistory');
            Route::get("notifications", Notifications::class)->name('myNotifications');
        });

        Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->group(function () {
        Route::middleware(['role:owner|superadmin'])->group(function () {
            Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('adminLogs');
            Route::get('/phpinfo', fn () => phpinfo());
            Route::get("roles-and-permissions", AdminSpatie::class)->name('adminSpatie');
            Route::get("users", AdminUsers::class)->name('adminUsers');
            Route::get("wallet-recharge", AdminWalletRechargeHistory::class)->name('adminWalletRechargeHistory');
            Route::get("user-wallet-recharge/{id}", AdminWalletRechargeHistory::class)->name('userWalletRechargeHistory');
        });

        Route::middleware(['role:owner|superadmin|admin|seo'])->group(function () {
            Route::get('dashboard', AdminDashboard::class)->name('adminDashboard');
            Route::get('setting', AdminSetting::class)->name('adminSetting');
        });

        Route::middleware(['role_or_permission:owner|all staff'])->group(function () {            
            Route::get("my-staff", MyStaffList::class)->name('myStaffList');
            Route::get("roles-and-permission/{id}", UserSpatie::class)->name('userSpatie');
        });
    });
});