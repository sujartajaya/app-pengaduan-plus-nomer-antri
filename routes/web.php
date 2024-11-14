<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CivitasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\QueueController;


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
    Route::get('/post',[CivitasController::class,'post']); /** form new post */
    Route::get('/view/posts',[PostController::class,'show']); /** view civitas post */
    Route::post('/post',[PostController::class,'store']);
    Route::get('/post/photo/{uuid}',[PostController::class,'editPhoto']);
    Route::post('/post/photo/{uuid}',[PostController::class,'savePhoto']);
    Route::get('/post/schedule/{uuid}',[CategoryController::class,'showPostByCategory']);
    Route::post('/post/schedule/{uuid}',[ScheduleController::class,'update']);
    Route::get('/post/edit/{uuid}',[PostController::class,'edit']);
    Route::patch('/post/edit/{uuid}',[PostController::class,'update']);
    Route::get('/schedule/view',[QueueController::class,'show']);
});

Route::middleware('civitas')->prefix('user')->group(function () {
    Route::get('/password', function () {
    return view('user.password');
    });
    Route::post('/password',[UserController::class,'update']);
});

/** testting route for limit */
Route::get('/display', function() {
    return view('display.layar');
});
