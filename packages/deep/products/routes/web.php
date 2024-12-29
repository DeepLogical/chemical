<?php

use Illuminate\Support\Facades\Route;

use Deep\Products\Http\Livewire\Admin\AdminProduct;
use Deep\Products\Http\Livewire\Admin\AdminForm;

use Deep\Products\Http\Livewire\Pages\ProductPage;
use Deep\Products\Http\Livewire\Pages\Form;

Route::middleware(['web'])->group(function () {
    Route::get("/product", ProductPage::class)->name('products');
    // Route::get("/tag/{url}", BlogPage::class)->name('tags');
    // Route::get("/category/{url}", BlogPage::class)->name('category');
    Route::get("form", Form::class)->name("form");

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::middleware(['role:owner|superadmin|admin|seo'])->prefix('admin')->group(function () {
            // Route::get("add-update-product/{id?}", AddUpdateBlog::class)->name('addUpdateBlog');
            Route::get("product", AdminProduct::class)->name('adminProduct');
            Route::get("form", AdminForm::class)->name('adminForm');
            // Route::get("blogmeta", AdminBlogmeta::class)->name('adminBlogmeta');
        });
    });
});