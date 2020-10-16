<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\AnnouncementsSave;

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

Route::get('/', [CarsController::class, 'getBlockData']);
Route::get('/getmodel', [CarsController::class, 'getModelsById']);
Route::get('/getcity', [CarsController::class, 'getCityById']);


Route::post('/', [CarsController::class, 'fetch'])->name('pagination.fetch');
Route::post('/announcements', [CarsController::class, 'getBlockData']);
Route::post('/store', [AnnouncementsSave::class, 'store']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
