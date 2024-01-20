<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AngolaHolidayAPIController extends Controller{
	private $apikey;
	private $apiUrl = "https://www.googleapis.com/calendar/v3/calendars/pt.ao%23holiday%40group.v.calendar.google.com/events?key=";

	public function __construct(){
		$this->apikey = env('GOOGLE_API_KEY', null);
		if ($this->apikey === null) {
			throw new \Exception('A chave da API do Google não está definida. Por favor, verifique o arquivo .env.');
		}
	}

	private function isWeekend($date) {
		$dayOfWeek = date('N', strtotime($date));
		return $dayOfWeek >= 6;
	}

    private function isHoliday($date, $data) {
		foreach ($data['items'] as $item) {
			if (isset($item['start']['date'])) {
				$holidayDate = substr($item['start']['date'], 0, 10);
				if ($date == $holidayDate) {
					return true;
				}
			}
		}
		return false;
	}

	public function isWeekendRoute(Request $request){
		$date = $request->input('date');
		$isWeekend = $this->isWeekend($date);
		return response()->json(["isWeekend" => $isWeekend]);
	}	
	
	public function isHolidayRoute(Request $request){
		$date = $request->input('date');
		$response = Http::get($this->apiUrl . $this->apikey);
		$data = $response->json();
		$isHoliday = $this->isHoliday($date, $data);
		return response()->json(["isHoliday" => $isHoliday]);
	}
	
	public function isHolidayOrWeekendRoute(Request $request){
		$date = $request->input('date');
		$response = Http::get($this->apiUrl . $this->apikey);
		$data = $response->json();
		$isHoliday = $this->isHoliday($date, $data);
		$isWeekend = $this->isWeekend($date);
		$isHolidayOrWeekend = $isHoliday || $isWeekend;
		return response()->json(["isHolidayOrWeekend" => $isHolidayOrWeekend]);
	}

	public function listHolidaysRoute(Request $request){
		$response = Http::get($this->apiUrl . $this->apikey);
		$data = $response->json();
		$holidays = [];
		foreach ($data['items'] as $item) {
			if (isset($item['start']['date'])) {
				$holidayDate = substr($item['start']['date'], 0, 10);
				$holidays[] = ['date' => $holidayDate, 'summary' => $item['summary']];
			}
		}
		return response()->json(["holidays" => $holidays]);
	}
}