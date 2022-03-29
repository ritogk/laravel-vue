<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
*/

// ユーザー認証系
Route::group(['prefix' => 'auth'], function () {
    // 管理者
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/me', [Controllers\Api\AuthAdminController::class, 'me'])->middleware(['auth:admin']);
        Route::post('/login', [Controllers\Api\AuthAdminController::class, 'login']);
        Route::post('/refresh', [Controllers\Api\AuthAdminController::class, 'refresh']);
        Route::post('/logout', [Controllers\Api\AuthAdminController::class, 'logout'])->middleware(['auth:admin']);
    });
    // 一般
    Route::group(['prefix' => 'front'], function () {
        Route::get('/me', [Controllers\Api\AuthFrontController::class, 'me'])->middleware(['auth:user']);
        Route::post('/login', [Controllers\Api\AuthFrontController::class, 'login']);
        Route::post('/logout', [Controllers\Api\AuthFrontController::class, 'logout'])->middleware(['auth:user']);
        Route::post('/refresh', [Controllers\Api\AuthFrontController::class, 'refresh']);
    });
});

// 仕事マスタ
Route::group(['prefix' => 'jobs'], function () {
    Route::get('/', [Controllers\Api\Master\JobController::class, 'list']);
    Route::get('/{id}', [Controllers\Api\Master\JobController::class, 'find']);
    Route::post('/', [Controllers\Api\Master\JobController::class, 'create'])->middleware(['auth:admin']);
    Route::put('/{id}', [Controllers\Api\Master\JobController::class, 'update'])->middleware(['auth:admin']);
    Route::delete('/{id}', [Controllers\Api\Master\JobController::class, 'destroy'])->middleware(['auth:admin']);
});

// 仕事カテゴリ マスタ
Route::group(['prefix' => 'job_categories'], function () {
    Route::get('/', [Controllers\Api\Master\JobCategoryController::class, 'list']);
    Route::get('/{id}', [Controllers\Api\Master\JobCategoryController::class, 'find']);
    Route::post('/', [Controllers\Api\Master\JobCategoryController::class, 'create'])->middleware(['auth:admin']);
    Route::put('/{id}', [Controllers\Api\Master\JobCategoryController::class, 'update'])->middleware(['auth:admin']);
    Route::delete('/{id}', [Controllers\Api\Master\JobCategoryController::class, 'destroy'])->middleware(['auth:admin']);
});

// エントリー マスタ
Route::group(['prefix' => 'entries'], function () {
    Route::get('/', [Controllers\Api\Master\EntryController::class, 'list'])->middleware(['auth:admin']);
    Route::post('/', [Controllers\Api\Master\EntryController::class, 'create'])->middleware(['auth:user']);
});

// 会員マスタ
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [Controllers\Api\Master\UserController::class, 'list'])->middleware(['auth:admin']);
    Route::post('/', [Controllers\Api\Master\UserController::class, 'create']);
});

// ファイル操作系
Route::group(['prefix' => 'files'], function () {
    Route::post('/', [Controllers\Api\FileController::class, 'upload'])->middleware(['auth:admin']);
});
