<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/my-skills', [SkillController::class, 'index'])->name('dashboard.skills');
    Route::post('/my-skills', [SkillController::class, 'store'])->name('skills.store');

    Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skills.destroy');
});



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::prefix('admin')->middleware(['auth','admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

    Route::post('/user/{id}/ban', [AdminController::class, 'banUser'])->name('admin.user.ban');

    Route::post('/user/{id}/report', [AdminController::class, 'reportUser'])->name('admin.user.report');

});



Route::get('/solar-wallpaper', function () {
    return view('solar-wallpaper');
});



require __DIR__.'/auth.php';
