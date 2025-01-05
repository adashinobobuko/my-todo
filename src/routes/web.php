<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 認証不要なルート
Route::get('/', [TodoController::class, 'index']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 認証が必要なルート（authミドルウェア適用）
Route::middleware('auth')->group(function () {
    Route::post('/todos', [TodoController::class, 'store']);
    Route::delete('/todos/delete', [TodoController::class, 'destroy']);
    Route::get('/my', [TodoController::class, 'mypage']);
    Route::get('/todos/search',[TodoController::class,'search']);
    //カテゴリー関連（ログインしていないと追加できない）
    Route::get('/categories',[CategoryController::class,'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
});

//Category関連
//Route::get('/categories',[CategoryController::class,'index']);
//Route::post('/categories', [CategoryController::class, 'store']);
