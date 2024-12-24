<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\WorldController;

use App\Livewire\Pages\Home;
use App\Livewire\Pages\Single;

Route::get('/', Home::class)->name('home');
Route::get("test", [WorldController::class, "test"])->name("test");
Route::get('spatieData', [WorldController::class, "spatieData"])->name("spatieData");
Route::post('imageCropPost', [WorldController::class, "imageCropPost"])->name("imageCropPost");

// For Email Verification
Route::get('/email/verify', function () { return view('auth.verify-email'); })->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get("/{url}", Single::class)->name('single');