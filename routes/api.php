<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Auth\SignUpController;
use \App\Http\Controllers\Auth\SignInController;
use \App\Http\Controllers\Auth\SignOutController;

use \App\Http\Controllers\User\ProfileController;


Route::group(['prefix'=>'auth'], function (){
    Route::post('signup', SignUpController::class);
    Route::post('signin', SignInController::class);
    Route::post('signout', SignOutController::class);
});

Route::get('profile', ProfileController::class);

