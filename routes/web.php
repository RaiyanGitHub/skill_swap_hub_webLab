<?php

//use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/form', [FormController::class, 'showForm']);
//Route::post('/form', [FormController::class, 'submitForm']);
/*Route::get('/form', function () {

    return view('form');

});
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//})->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/dashboard/skills/{id}', [SkillController::class, 'destroy'])->name('skills.destroy');
});
Route::get('/solar-wallpaper', function () {

    return view('solar-wallpaper');

});


Route::get('/my-skills', [SkillController::class, 'index'])->middleware('auth');


Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    // Dashboard main page
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Skills
    Route::get('/my-skills', [SkillController::class, 'index'])->name('dashboard.skills');

    Route::post('/my-skills', [SkillController::class, 'store'])->name('skills.store');

});


require __DIR__.'/auth.php';
