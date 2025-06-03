<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

//User CRUD
Route::get('/get-users', [UserController::class, 'getUsers']);
Route::post('/add-user', [UserController::class, 'addUser']);
Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

//Deal CRUD
Route::get('/get-deals', [DealController::class, 'getDeals']);
Route::post('/add-deals', [DealController::class, 'addDeals']);
Route::put('/edit-deals/{id}', [DealController::class, 'editDeals']);
Route::delete('/delete-deals/{id}', [DealController::class, 'deleteDeals']);

Route::post('/logout', [AuthenticationController::class, 'logout']);
});
