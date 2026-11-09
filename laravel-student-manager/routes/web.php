<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeveloppeurController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('students.index');
});

Route::resource('students', StudentController::class);

Route::get('/developpeurs', [DeveloppeurController::class, 'create'])->name('developpeurs.create');
Route::post('/developpeurs', [DeveloppeurController::class, 'store'])->name('developpeurs.store');
