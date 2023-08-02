<?php

// namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::group(['middleware' => 'auth'], function () {

    Route::get('/test', function () {
        return ('test');
    });

    Route::get('/suggestions', [UserController::class, 'suggestions'])->name('suggestions');
    Route::get('/connections', [UserController::class, 'connections'])->name('connections');
    Route::get('/common-connections/{userId}', [UserController::class, 'commonConnections'])->name('commonConnections');

    Route::get('/received/Requests', [UserController::class, 'receivedRequests'])->name('receivedRequests');


    Route::post('/connect/{user}',  [UserController::class, 'sendConnectionRequest'])->name('sendConnectionRequest');
    Route::post('/accept-request/{id}', [UserController::class, 'acceptRequest'])->name('acceptRequest');


    Route::post('/delete-invitation/{id}', [UserController::class, 'deleteInvitation'])->name('deleteInvitation');

    Route::post('/delete-connection/{id}', [UserController::class, 'deleteConnection'])->name('deleteConnection');
    Route::get('/invited-users', [UserController::class, 'invitedUsers'])->name('invitedUsers');
});
