<?php

namespace Tests\Unit;

use App\Http\Controllers\AngolaHolidayAPIController;
use Illuminate\Http\Request;
use Tests\TestCase;

class AngolaHolidayAPITest extends TestCase
{
    public function testIsWeekendRoute()
    {
        $controller = new AngolaHolidayAPIController();
        $request = Request::create('/isWeekend', 'POST', ['date' => '2024-01-06']);
        $response = $controller->isWeekendRoute($request);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('{"isWeekend":true}', $response->getContent());
    }

    public function testIsHolidayRoute()
    {
        $controller = new AngolaHolidayAPIController();
        $request = Request::create('/isHoliday', 'POST', ['date' => '2024-01-01']);
        $response = $controller->isHolidayRoute($request);
        $this->assertEquals(200, $response->getStatusCode());
        // Supondo que 1º de janeiro de 2024 seja feriado
        $this->assertEquals('{"isHoliday":true}', $response->getContent());
    }

    public function testIsHolidayOrWeekendRoute()
    {
        $controller = new AngolaHolidayAPIController();
        $request = Request::create('/isHolidayOrWeekend', 'POST', ['date' => '2024-01-06']);
        $response = $controller->isHolidayOrWeekendRoute($request);
        $this->assertEquals(200, $response->getStatusCode());
        // Supondo que 6 de janeiro de 2024 seja fim de semana
        $this->assertEquals('{"isHolidayOrWeekend":true}', $response->getContent());
    }
}
