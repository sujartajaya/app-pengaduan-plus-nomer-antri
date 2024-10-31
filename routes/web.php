<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CivitasController;



Route::get('/',[UserController::class,'index']);
Route::get('/user/register',[UserController::class,'create'])->name('register');
Route::get('/user/login',[UserController::class,'login'])->name('login');
Route::post('/user/register',[UserController::class,'store']);
Route::post('/user/login',[UserController::class,'authenticate']);
Route::post('/user/logout',[UserController::class,'actionlogout']);
Route::middleware('civitas')->prefix('civitas')->group(function () {
    Route::get('/',[UserController::class,'index'])->name('home');
    Route::post('/register',[CivitasController::class,'store']);
    Route::get('/profile',[CivitasController::class,'index'])->name('profile');
    Route::post('/photo',[CivitasController::class,'uploadPhoto']);
    Route::get('/edit',[CivitasController::class,'edit']);
    Route::patch('/edit',[CivitasController::class,'update']);
    Route::get('/photo', function () {
    return view('civitas.photo');
    });
    Route::get('/post',[CivitasController::class,'post']);
});

Route::middleware('civitas')->prefix('user')->group(function () {
    Route::get('/password', function () {
    return view('user.password');
    });
    Route::post('/password',[UserController::class,'update']);
});