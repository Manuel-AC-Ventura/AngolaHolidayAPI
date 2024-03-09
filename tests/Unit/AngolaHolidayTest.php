<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AngolaHolidayTest extends TestCase
{
    /**
     * Test the listHolidays method.
     *
     * @return void
     */
    public function testListHolidays()
    {
        $response = $this->get('/api/listHolidays');

        $response->assertStatus(200);
    }

    /**
     * Test the isWeekend method.
     *
     * @return void
     */
    public function testIsWeekend()
    {
        $response = $this->postJson('/api/isWeekend', ['date' => '2024-03-09']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'isWeekend' => true,
            ]);
    }

    /**
     * Test the isHoliday method.
     *
     * @return void
     */
    public function testIsHoliday()
    {
        $response = $this->postJson('/api/isHoliday', ['date' => '2024-03-09']);

        $response->assertStatus(200);
    }

    /**
     * Test the isHolidayOrWeekend method.
     *
     * @return void
     */
    public function testIsHolidayOrWeekend()
    {
        $response = $this->postJson('/api/isHolidayOrWeekend', ['date' => '2024-03-09']);

        $response->assertStatus(200);
    }
}
