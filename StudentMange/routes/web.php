<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/ocr', [App\Http\Controllers\OcrController::class, 'ocrImage']);
Route::get('/', function () {
    return view('auth.register');
});
Route::get('/test-api', function () {
    $user=User::all();
    return view('api',['user'=>$user]);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/view_blade', [App\Http\Controllers\HomeController::class, 'view_blade'])->name('view_blade');
Route::get('/insert_blade', [App\Http\Controllers\HomeController::class, 'insert_blade'])->name('insert_blade');
Route::get('/this_person_info/{id}', [App\Http\Controllers\HomeController::class, 'this_person_info'])->name('this_person_info');
Route::get('/edit_blade/{id}', [App\Http\Controllers\HomeController::class, 'edit_blade'])->name('edit_blade');
Route::get('/delete_blade/{id}', [App\Http\Controllers\HomeController::class, 'delete_blade'])->name('delete_blade');
Route::post('/insert_information', [App\Http\Controllers\HomeController::class, 'insert_information'])->name('insert_information');
Route::post('/edit_information', [App\Http\Controllers\HomeController::class, 'edit_information'])->name('edit_information');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
