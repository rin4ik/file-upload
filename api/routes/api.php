<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class);
Route::post('/files/signed', [FileController::class, 'signed']);
Route::get('/files', [FileController::class, 'index']);
Route::post('/files', [FileController::class, 'store']);
Route::delete('/files/{file:uuid}', [FileController::class, 'destroy']);
