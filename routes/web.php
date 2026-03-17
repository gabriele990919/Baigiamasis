<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoryController::class,'index']);

Route::get('/dashboard', [StoryController::class,'index'])
->middleware(['auth','verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/create', [StoryController::class,'create']);
    Route::post('/store', [StoryController::class,'store']);
    Route::delete('/story/{id}', [StoryController::class,'destroy']);
    Route::post('/like/{story_id}', [LikeController::class,'store']);

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';


