<?php

use App\Http\Controllers\AngolaHolidayController;
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

/*
    Route::get('/', function () {
        return view('welcome');
    });
*/


Route::get("/listHolidays", [AngolaHolidayController::class,"listHolidays"]);
Route::post("/isWeekend", [AngolaHolidayController::class,"isWeekend"]);
Route::post("/isHoliday", [AngolaHolidayController::class,"isHoliday"]);
Route::post("/isHolidayOrWeekend", [AngolaHolidayController::class,"isHolidayOrWeekend"]);
Route::fallback(function () {
    return response()->json(['message' => 'Rota não encontrada.'], 404);
});