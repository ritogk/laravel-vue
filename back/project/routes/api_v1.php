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
        Route::get('/me', [Controllers\Api\V1\AuthAdminController::class, 'me'])->middleware(['auth:admin']);
        Route::post('/login', [Controllers\Api\V1\AuthAdminController::class, 'login']);
        Route::post('/refresh', [Controllers\Api\V1\AuthAdminController::class, 'refresh']);
        Route::post('/logout', [Controllers\Api\V1\AuthAdminController::class, 'logout'])->middleware(['auth:admin']);
    });
    // 一般
    Route::group(['prefix' => 'front'], function () {
        Route::get('/me', [Controllers\Api\V1\AuthFrontController::class, 'me'])->middleware(['auth:user']);
        Route::post('/login', [Controllers\Api\V1\AuthFrontController::class, 'login']);
        Route::post('/logout', [Controllers\Api\V1\AuthFrontController::class, 'logout'])->middleware(['auth:user']);
        Route::post('/refresh', [Controllers\Api\V1\AuthFrontController::class, 'refresh']);
    });
});

// 仕事マスタ
Route::group(['prefix' => 'jobs'], function () {
    Route::get('/', [Controllers\Api\V1\JobController::class, 'list']);
    Route::get('/{id}', [Controllers\Api\V1\JobController::class, 'find']);
    Route::post('/', [Controllers\Api\V1\JobController::class, 'create'])->middleware(['auth:admin']);
    Route::put('/{id}', [Controllers\Api\V1\JobController::class, 'update'])->middleware(['auth:admin']);
    Route::delete('/{id}', [Controllers\Api\V1\JobController::class, 'destroy'])->middleware(['auth:admin']);
});

// 仕事カテゴリ マスタ
Route::group(['prefix' => 'job_categories'], function () {
    Route::get('/', [Controllers\Api\V1\JobCategoryController::class, 'list']);
    Route::get('/{id}', [Controllers\Api\V1\JobCategoryController::class, 'find']);
    Route::post('/', [Controllers\Api\V1\JobCategoryController::class, 'create'])->middleware(['auth:admin']);
    Route::put('/{id}', [Controllers\Api\V1\JobCategoryController::class, 'update'])->middleware(['auth:admin']);
    Route::delete('/{id}', [Controllers\Api\V1\JobCategoryController::class, 'destroy'])->middleware(['auth:admin']);
});

// エントリー マスタ
Route::group(['prefix' => 'entries'], function () {
    Route::get('/', [Controllers\Api\V1\EntryController::class, 'list'])->middleware(['auth:admin']);
    Route::post('/', [Controllers\Api\V1\EntryController::class, 'create'])->middleware(['auth:user']);
});

// 会員マスタ
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [Controllers\Api\V1\UserController::class, 'list'])->middleware(['auth:admin']);
    Route::post('/', [Controllers\Api\V1\UserController::class, 'create']);
});

// ファイル操作系
Route::group(['prefix' => 'files'], function () {
    Route::post('/', [Controllers\Api\V1\FileController::class, 'upload'])->middleware(['auth:admin']);
});


// ロードバランサーのヘルスチェック用
Route::get('/helth-check', function () {
    return response()->json(
        [],
        200
    );
});
