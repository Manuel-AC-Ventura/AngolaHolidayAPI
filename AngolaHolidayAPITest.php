<?php

require_once('./index.php');

use PHPUnit\Framework\TestCase;
class AngolaHolidayAPITest extends TestCase
{
    private $angolaHolidayAPI;

    protected function setUp(): void
    {
        $this->angolaHolidayAPI = new AngolaHolidayAPI();
    }

    public function testIsWeekend()
    {
        $method = new ReflectionMethod(AngolaHolidayAPI::class, 'isWeekend');
        $method->setAccessible(true);

        $result = $method->invokeArgs($this->angolaHolidayAPI, ['2024-01-06']); // 6 de janeiro de 2024 é um sábado
        $this->assertTrue($result);

        $result = $method->invokeArgs($this->angolaHolidayAPI, ['2024-01-07']); // 7 de janeiro de 2024 é um domingo
        $this->assertTrue($result);

        $result = $method->invokeArgs($this->angolaHolidayAPI, ['2024-01-08']); // 8 de janeiro de 2024 é uma segunda-feira
        $this->assertFalse($result);
    }

	public function testIsHoliday() {
		$service = new AngolaHolidayAPI();
		$date = '2024-02-04'; // Uma data que você sabe que é feriado
	
		$method = new ReflectionMethod('AngolaHolidayAPI', 'isHoliday');
		$method->setAccessible(true);
	
		$data = [
			'items' => [
				[
					'start' => [
						'date' => '2024-02-04T00:00:00Z'
					]
				]
				// Adicione outros feriados aqui
			]
		];
		$result = $method->invoke($service, $date, $data);
	
		$this->assertTrue($result, "A data {$date} deve ser um feriado");
	}
	
	
	

    public function testIsHolidayOrWeekend()
    {
        // Este é um exemplo de como você pode testar o método isHolidayOrWeekend.
        // Você precisará substituir este código com uma implementação que faça sentido para o seu caso de uso específico.
        $result = $this->angolaHolidayAPI->isHolidayOrWeekend('2024-01-06'); // 6 de janeiro de 2024 é um sábado
        $this->assertTrue(json_decode($result)->isHolidayOrWeekend);

        $result = $this->angolaHolidayAPI->isHolidayOrWeekend('2024-01-08'); // 8 de janeiro de 2024 é uma segunda-feira
        $this->assertFalse(json_decode($result)->isHolidayOrWeekend);
    }
}
