<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'index']);
Route::post('/home', [HomeController::class, 'pagination']);
Route::get('/home/create', [HomeController::class, 'create']);
Route::post('/home/create', [HomeController::class, 'store']);
Route::get('/home/edit/{home}', [HomeController::class, 'edit']);
Route::put('/home/edit/{home}', [HomeController::class, 'update']);
Route::delete('/home/delete/{home}', [HomeController::class, 'destroy']);
Route::resource('properties', PropertyController::class)->except(['show']);

