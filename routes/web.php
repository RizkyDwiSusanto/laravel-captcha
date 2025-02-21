<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\QRCodeController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/captcha-image', [CaptchaController::class, 'getCaptchaImage'])->name('captcha.image');

Route::controller(QRCodeController::class)->group(function () {
    Route::get('/qrcode', [QRCodeController::class, 'index']);
    Route::post('generate-qr-code', 'generateQrCode')->name('generate-qr-code');
});
// Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha.generate');
// Route::post('/validate-captcha', [CaptchaController::class, 'validateCaptcha'])->name('captcha.validate');