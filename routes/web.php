<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SwapController;
use App\Http\Controllers\RatingController;

/*
--------------------------------------------------------------------------
 Public
--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/solar-wallpaper', function () {
    return view('solar-wallpaper');
});

/*
--------------------------------------------------------------------------
 Authenticated User Routes
--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    --------------------------
     Dashboard + Skills
    --------------------------
    */
    Route::prefix('dashboard')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/my-skills', [SkillController::class, 'index'])->name('dashboard.skills');
        Route::post('/my-skills', [SkillController::class, 'store'])->name('skills.store');
        Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skills.destroy');

        //  Explore
        Route::get('/explore', [DashboardController::class, 'explore'])->name('dashboard.explore');
    });

    /*
    --------------------------
     Swap System
    --------------------------
    */
    Route::get('/requests', [SwapController::class, 'incoming'])->name('requests.incoming');

    Route::post('/swap/send/{user}', [SwapController::class, 'send'])->name('swap.send');

    Route::post('/swap/{id}/accept', [SwapController::class, 'accept'])->name('swap.accept');
    Route::post('/swap/{id}/reject', [SwapController::class, 'reject'])->name('swap.reject');
    Route::post('/swap/{id}/complete', [SwapController::class, 'complete'])->name('swap.complete');

    /*
    |--------------------------
    | Video Call (Jitsi)
    |--------------------------
    */
    Route::get('/call/{id}', function ($id) {
        return view('video.call', ['room' => "swap_".$id."_".auth()->id()]);
    })->name('video.call');


    /*
    --------------------------
     Rating
    --------------------------
    */
    Route::post('/rating/{swap}', [RatingController::class, 'store'])->name('rating.store');

    /*
    --------------------------
     Profile
    --------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
--------------------------------------------------------------------------
 Admin
--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

    Route::post('/user/{id}/ban', [AdminController::class, 'banUser'])->name('admin.user.ban');

    Route::post('/user/{id}/report', [AdminController::class, 'reportUser'])->name('admin.user.report');

});

/*--------------------------------------------------------------------------
 Auth (Breeze / Fortify)
--------------------------------------------------------------------------*/

require __DIR__.'/auth.php';
