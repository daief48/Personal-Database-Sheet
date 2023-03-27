<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransferController;



Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login');
    Route::post('auth/register', 'register');
    Route::post('auth/logout', 'logout');
    Route::post('auth/refresh', 'refresh');
    Route::post('auth/otpVerify', 'otpVerify');

});


Route::group(['prefix'=>''], function(){

    Route::get('users', [UserController::class, 'getUsers']);
    Route::get('users/search', [UserController::class, 'search']);
    Route::post('addUser', [UserController::class, 'addUser']);
    Route::get('users/{id}', [UserController::class, 'userDetail']);
    Route::put('users/{id}', [UserController::class, 'updateUser']);
    Route::delete('users/{id}', [UserController::class, 'deleteUser']);
});

//User Profile Information v1

Route::get('/user/getprofile/{id}', [ProfileController::class, 'getprofile']);
Route::post('/user/addProfile', [ProfileController::class, 'addProfile']);
Route::post('/user/updateProfile', [ProfileController::class, 'updateProfile']);

//User Transfer Information v1

Route::get('/getTransferList', [TransferController::class, 'getTransferList']);
Route::post('/addTransferRecord', [TransferController::class, 'addTransferRecord']);   
Route::post('/updateTransferRecord', [TransferController::class, 'updateTransferRecord']);
Route::delete('/deleteTransferRecord/{id}', [TransferController::class, 'deleteTransferRecord']);
Route::patch('/activeTransferRecord/{id}', [TransferController::class, 'activeTransferRecord']);
Route::patch('/inactiveTransferRecord/{id}', [TransferController::class, 'inactiveTransferRecord']);

// Mail Controller

Route::post('/send-reply', [MailController::class, 'sendReply']);



