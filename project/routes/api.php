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
        Route::get('/me', [Controllers\Api\AdminAuthController::class, 'me'])->middleware(['auth:admin']);
        Route::post('/login', [Controllers\Api\AdminAuthController::class, 'login']);
        Route::post('/refresh', [Controllers\Api\AdminAuthController::class, 'refresh']);
        Route::post('/logout', [Controllers\Api\AdminAuthController::class, 'logout'])->middleware(['auth:admin']);
    });
    // 一般
    Route::group(['prefix' => 'front'], function () {
        Route::get('/user', [Controllers\Api\FrontAuthController::class, 'user'])->middleware(['auth:user']);
        Route::post('/register', [Controllers\Api\FrontAuthController::class, 'register'])->middleware(['guest:user']);
        Route::post('/login', [Controllers\Api\FrontAuthController::class, 'login']);
        Route::post('/logout', [Controllers\Api\FrontAuthController::class, 'logout']);
    });
});

// 仕事マスタ
Route::group(['prefix' => 'jobs'], function () {
    Route::get('/', [Controllers\Api\Master\JobController::class, 'index']);
    Route::get('/{id}', [Controllers\Api\Master\JobController::class, 'find']);
    Route::post('/', [Controllers\Api\Master\JobController::class, 'create'])->middleware(['auth:admin']);
    Route::put('/{id}', [Controllers\Api\Master\JobController::class, 'update'])->middleware(['auth:admin']);
    Route::delete('/{id}', [Controllers\Api\Master\JobController::class, 'destroy'])->middleware(['auth:admin']);
    Route::get('/files/excel', [Controllers\Api\Master\JobController::class, 'excel'])->middleware(['auth:admin']);
});

// 仕事カテゴリ マスタ
Route::group(['prefix' => 'job_categories'], function () {
    Route::get('/', [Controllers\Api\Master\JobCategoryController::class, 'index']);
    Route::get('/{id}', [Controllers\Api\Master\JobCategoryController::class, 'find']);
    Route::post('/', [Controllers\Api\Master\JobCategoryController::class, 'create'])->middleware(['auth:admin']);
    Route::put('/{id}', [Controllers\Api\Master\JobCategoryController::class, 'update'])->middleware(['auth:admin']);
    Route::delete('/{id}', [Controllers\Api\Master\JobCategoryController::class, 'destroy'])->middleware(['auth:admin']);
    Route::get('/files/excel', [Controllers\Api\Master\JobCategoryController::class, 'excel'])->middleware(['auth:admin']);
});

// エントリー マスタ
Route::group(['prefix' => 'entries'], function () {
    Route::get('/', [Controllers\Api\Master\EntryController::class, 'index']);
    Route::post('/', [Controllers\Api\Master\EntryController::class, 'create'])->middleware(['auth:user']);
});

// 会員マスタ
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [Controllers\Api\Master\UserController::class, 'index'])->middleware(['auth:admin']);
});

// メルマガマスタ
Route::group(['prefix' => 'news_letters'], function () {
    Route::get('/', [Controllers\Api\Master\NewsLetterController::class, 'index']);
    Route::get('/{id}', [Controllers\Api\Master\NewsLetterController::class, 'find']);
    Route::post('/', [Controllers\Api\Master\NewsLetterController::class, 'create'])->middleware(['auth:admin']);
    Route::put('/{id}', [Controllers\Api\Master\NewsLetterController::class, 'update'])->middleware(['auth:admin']);
    Route::delete('/{id}', [Controllers\Api\Master\NewsLetterController::class, 'destroy'])->middleware(['auth:admin']);
    Route::post('/{id}/send', [Controllers\Api\Master\NewsLetterController::class, 'send'])->middleware(['auth:admin']);
});

// ファイル操作系
Route::group(['prefix' => 'files'], function () {
    Route::post('/', [Controllers\Api\FileController::class, 'upload'])->middleware(['auth:admin']);
});
