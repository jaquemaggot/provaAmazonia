<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/users', [UserController::class, 'GetAll']);
Route::post('/user',[UserController::class, 'Insert']);
Route::put('/user/{id}',[UserController::class, 'Update']);
Route::get('/user/{id}', [UserController::class,'GetById']);
Route::delete('/user/{id}',[UserController::class,'Delete']);