<?php

use Illuminate\Support\Facades\Route;
use Deep\Products\Http\Livewire\Admin\AdminProductmeta;
use Deep\Products\Http\Livewire\Admin\AdminProduct;
use Deep\Products\Http\Livewire\Admin\AddUpdateProduct;
use Deep\Products\Http\Livewire\Admin\AdminForm;

use Deep\Products\Http\Livewire\Pages\ProductListing;
use Deep\Products\Http\Livewire\Pages\ProductSingle;
use Deep\Products\Http\Livewire\Pages\Form;

use Deep\Products\Http\Livewire\Parts\ProductSidebar;
use Deep\Products\Http\Livewire\Parts\SuggestProduct;


Route::middleware(['web'])->group(function () {
    Route::get("product-listing", ProductListing::class)->name('productListing');
    Route::get("product/{url}", ProductSingle::class)->name('productSingle');
    Route::get("form", Form::class)->name("form");

    
    
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::middleware(['role:owner|superadmin|admin|seo'])->prefix('admin')->group(function () {
            Route::get("add-update-product/{id?}", AddUpdateProduct::class)->name('addUpdateProduct');
            Route::get("productmeta", AdminProductmeta::class)->name('adminProductmeta');
            Route::get("product", AdminProduct::class)->name('adminProduct');
            Route::get("product-sidebar", ProductSidebar::class)->name('productSidebar');
            Route::get("suggest-product", SuggestProduct::class)->name('suggestProduct');
            Route::get("form", AdminForm::class)->name('adminForm');
        });
    });

});