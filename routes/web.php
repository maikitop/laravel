<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthController;
use App\http\Controllers\ReportController;
use App\http\Controllers\MainController;
use App\http\Controllers\AdminController;

//главная страница
Route::get('/', [MainController::class, 'index'])->name('home');

// роуты без входа в аккаунт
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
//роуты с входом в аккаунт.
Route::middleware('auth')->group(function () {
    route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/my-reports', [ReportController::class, 'index'])->name('reports.index');

    // Формирование заявления
    Route::get('/report/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/report/create', [ReportController::class, 'store']);

    // Оставить отзыв
    Route::post('/report/{id}/feedback', [ReportController::class, 'feedback'])->name('reports.feedback');
});
// Роуты для администратора
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/report/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
});
