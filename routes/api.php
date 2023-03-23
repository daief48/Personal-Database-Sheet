<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;



Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login');
    Route::post('auth/register', 'register');
    Route::post('auth/logout', 'logout');
    Route::post('auth/refresh', 'refresh');

});


Route::group(['prefix'=>''], function(){

    Route::get('users', [UserController::class, 'getUsers']);
    Route::get('users/search', [UserController::class, 'search']);
    Route::post('addUser', [UserController::class, 'addUser']);
    Route::get('users/{id}', [UserController::class, 'userDetail']);
    Route::put('users/{id}', [UserController::class, 'updateUser']);
    Route::delete('users/{id}', [UserController::class, 'deleteUser']);
    
    
    

});






// Mail Controller

Route::post('/send-reply', [MailController::class, 'sendReply']);



