<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FibonacciController;

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

Route::post('/fibonacci', [FibonacciController::class, "calculate"]);
Route::get('/fibonacci', [FibonacciController::class, 'index']);
Route::get('/fibonacci/{query}', [FibonacciController::class, 'show']);
Route::put('/fibonacci/{query}', [FibonacciController::class, 'update']); 
Route::patch('/fibonacci/{query}', [FibonacciController::class, 'partialUpdate']);
Route::delete('/fibonacci/{query}', [FibonacciController::class, 'destroy']);