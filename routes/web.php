<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\EventController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[PostController::class,'index2']);
Route::post('/',[PostController::class,'aa']);
Route::get('/kasus',[KasusController::class,'index']);
Route::post('/kasus',[KasusController::class,'store']);

Route::resource('/posts',PostController::class);
Route::get('/a',[PostController::class,'ac']);
Route::get('/ad/{bulanTahun}',[PostController::class,'ad']);

Route::get('/event',[EventController::class,'index']);
Route::Post('/event',[EventController::class,'ajax']);
