<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\StripeIntentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserPlanAvailabilityController;
use App\Http\Controllers\UserUsageController;
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

Route::get('/user', UserController::class);
Route::get('/user/usage', UserUsageController::class);
Route::get('/user/plan_availability', UserPlanAvailabilityController::class);
Route::post('/login', LoginController::class);
Route::post('/logout', LogoutController::class);
Route::post('/files/signed', [FileController::class, 'signed']);
Route::get('/files', [FileController::class, 'index']);
Route::post('/files', [FileController::class, 'store']);
Route::delete('/files/{file:uuid}', [FileController::class, 'destroy']);
Route::get('/plans', PlanController::class);
Route::get('/subscriptions/intent', StripeIntentController::class);
Route::post('/subscriptions', [SubscriptionController::class, 'store']);
Route::patch('/subscriptions', [SubscriptionController::class, 'update']);
