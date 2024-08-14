<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('add-user',[ApiController::class,'addUser']);
Route::get('users',[ApiController::class,'userAll']);
Route::get('user/{id}',[ApiController::class,'userById']);
Route::delete('delete_st/{id}',[ApiController::class,'deleteById']);
Route::put('edit_st/{id}',[ApiController::class,'editById']);
