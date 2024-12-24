<?php

use Illuminate\Support\Facades\Route;

use Deep\Blogs\Http\Livewire\Admin\AddUpdateBlog;
use Deep\Blogs\Http\Livewire\Admin\AdminBlog;
use Deep\Blogs\Http\Livewire\Admin\AdminAuthor;
use Deep\Blogs\Http\Livewire\Admin\AdminBlogmeta;

use Deep\Blogs\Http\Livewire\Pages\BlogPage;
use Deep\Blogs\Http\Livewire\Pages\WriteForUs;

Route::middleware(['web'])->group(function () {
    Route::get("/blog", BlogPage::class)->name('blogs');
    Route::get("/tag/{url}", BlogPage::class)->name('tags');
    Route::get("/category/{url}", BlogPage::class)->name('category');
    Route::get("write-for-us", writeForUs::class)->name("writeForUs");

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::middleware(['role:owner|superadmin|admin|seo'])->prefix('admin')->group(function () {
            Route::get("add-update-blog/{id?}", AddUpdateBlog::class)->name('addUpdateBlog');
            Route::get("blog", AdminBlog::class)->name('adminBlog');
            Route::get("author", AdminAuthor::class)->name('adminAuthor');
            Route::get("blogmeta", AdminBlogmeta::class)->name('adminBlogmeta');
        });
    });
});