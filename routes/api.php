<?php

use App\Http\Controllers\Api\Auth\AuthApiController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PermissionUserController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/me', [AuthApiController::class, 'me'])->name('auth.me')->middleware('auth:sanctum');
Route::post('/logout', [AuthApiController::class, 'logout'])->name('auth.logout')->middleware('auth:sanctum');
Route::post('/login', [AuthApiController::class, 'auth'])->name('auth.login');

Route::middleware(['auth:sanctum','acl'])->group(function () {
Route::apiResource('/permissions', PermissionController::class);
Route::post('/users/{user}/sync-profiles', [PermissionUserController::class, 'syncProfilesOfUser'])
    ->name('users.profiles.sync');
Route::apiResource('/users', UserController::class);
Route::apiResource('/profiles', ProfileController::class);
Route::post('/profiles/{profile}/sync-permissions', [ProfileController::class, 'syncProfilePermissions'])
    ->name('profiles.syncPermissions');

});

Route::get('/', fn () => response()->json(['message' => 'ok']));
