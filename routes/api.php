<?php

use App\Http\Controllers\AngolaHolidayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('api')->group(function () {
    Route::get("/listHolidays", [AngolaHolidayController::class,"listHolidays"]);
    Route::post("/isWeekend", [AngolaHolidayController::class,"isWeekend"]);
    Route::post("/isHoliday", [AngolaHolidayController::class,"isHoliday"]);
    Route::post("/isHolidayOrWeekend", [AngolaHolidayController::class,"isHolidayOrWeekend"]);
    Route::fallback(function () {
        return response()->json(['message' => 'Rota não encontrada.'], 404);
    });
});