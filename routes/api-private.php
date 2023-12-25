<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Policies\AdminPolicy;

// TODO 1 Add sanctum
// Route::group(['middleware' => ['auth:sanctum']], function () {

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'edit']);
    Route::delete('/{id}', [UserController::class, 'destroy']);

// TODO 1 Add policies

//    Route::get('/', [UserController::class, 'index'])->can('crud', AdminPolicy::class);
//    Route::get('/{id}', [UserController::class, 'show'])->can('crud', AdminPolicy::class);
//    Route::post('/', [UserController::class, 'store'])->can('crud', AdminPolicy::class);
//    Route::put('/{id}', [UserController::class, 'edit'])->can('crud', AdminPolicy::class);
//    Route::delete('/{id}', [UserController::class, 'destroy'])->can('crud', AdminPolicy::class);
});