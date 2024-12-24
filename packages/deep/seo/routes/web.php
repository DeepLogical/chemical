<?php

use Illuminate\Support\Facades\Route;

use Deep\Seo\Http\Livewire\Seo\AdminMeta;
use Deep\Seo\Http\Livewire\Seo\AdminSitemap;

use Deep\Seo\Http\Livewire\Seo\UploadMeta;
use Deep\Seo\Http\Livewire\Seo\AdminPageScan;

Route::middleware(['web'])->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::middleware(['role:owner|superadmin|admin|seo'])->prefix('admin')->group(function () {    
            Route::get("page-scan", AdminPageScan::class)->name('adminPageScan');
            Route::get("meta", AdminMeta::class)->name('adminMeta');
            Route::get("sitemap", AdminSitemap::class)->name('adminSitemap');

            Route::get('upload-meta/{batch}', UploadMeta::class)->name('uploadMeta');
        });
    });
});