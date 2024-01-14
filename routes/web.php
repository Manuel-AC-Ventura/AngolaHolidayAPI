<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Request;
use App\Http\Controllers\AngolaHolidayAPIController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return "Bem-vindo à API AngolaHoliday!";
});

$router->post('/isWeekend', function(Request $request) use ($router){
    $controller = new AngolaHolidayAPIController();
    return $controller->isWeekendRoute($request);
});

$router->post('/isHoliday', function(Request $request) use ($router){
    $controller = new AngolaHolidayAPIController();
    return $controller->isHolidayRoute($request);
});

$router->post('/isHolidayOrWeekend', function (Request $request) use ($router) {
    $controller = new AngolaHolidayAPIController();
    return $controller->isHolidayOrWeekendRoute($request);
});

$router->get('/{route:.*}/', function () {
    return response()->json(['message' => 'Rota GET não encontrada'], 404);
});

$router->post('/{route:.*}/', function () {
    return response()->json(['message' => 'Rota POST não encontrada'], 404);
});
