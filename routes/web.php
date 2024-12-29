<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Worldcontroller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use App\Livewire\Pages\Home;
use App\Livewire\Pages\Single;


Route::get('/', Home::class)->name('home');
Route::get("test", [WorldController::class, "test"])->name("test");
Route::get('spatieData', [Worldcontroller::class, "spatieData"])->name("spatieData");
Route::post('imageCropPost', [WorldController::class, "imageCropPost"])->name("imageCropPost");

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
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
