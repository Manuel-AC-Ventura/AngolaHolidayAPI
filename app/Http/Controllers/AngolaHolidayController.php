<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

/**
 * @OA\Info(title="Angola Holiday API", version="0.1")
 */
class AngolaHolidayController extends Controller
{
    private $googleApiKey;

    public function __construct() {
        $this->googleApiKey = env('GOOGLE_API_KEY');
    }

    /**
     * @OA\Get(
     *     path="/api/listHolidays",
     *     @OA\Response(response="200", description="List of holidays")
     * )
     */
    public function listHolidays(){
        try {
            // Você pode usar a API do Google para listar os feriados
            $url = "https://www.googleapis.com/calendar/v3/calendars/pt.ao%23holiday%40group.v.calendar.google.com/events?key={$this->googleApiKey}";
            $json = @file_get_contents($url);

            if ($json === false) {
                throw new Exception('Não foi possível acessar a API do Google.');
            }

            $holidays = json_decode($json, true);

            if ($holidays === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Erro ao decodificar o JSON.');
            }

            $currentYear = date('Y');
            $holidayData = [];
            foreach ($holidays['items'] as $holiday) {
                $holidayYear = date('Y', strtotime($holiday['start']['date']));
                if ($holidayYear == $currentYear) {
                    $holidayData[] = [
                        'date' => $holiday['start']['date'],
                        'summary' => $holiday['summary']
                    ];
                }
            }
        
            return $holidayData;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }    

    /**
     * @OA\Post(
     *     path="/api/isWeekend",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="date",
     *                     type="string"
     *                 ),
     *                 example={"date": "2024-03-09"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Check if a date is a weekend")
     * )
     */
    public function isWeekend(Request $request){
        try {
            $date = Carbon::parse($request->date);

            return $date->isWeekend();
        } catch (Exception $e) {
            return response()->json(['error' => 'Por favor, forneça a data no formato correto (YYYY-MM-DD).'], 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/isHoliday",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="date",
     *                     type="string"
     *                 ),
     *                 example={"date": "2024-03-09"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Check if a date is a holiday")
     * )
     */
    public function isHoliday(Request $request){
        try {
            $holidays = $this->listHolidays();
            $date = Carbon::parse($request->date)->format('Y-m-d');
        
            if (isset($holidays['items'])) {
                foreach ($holidays['items'] as $holiday) {
                    if (Carbon::parse($holiday['start']['date'])->format('Y-m-d') == $date) {
                        return true;
                    }
                }
            }
        
            return false;
        } catch (Exception $e) {
            return response()->json(['error' => 'Por favor, forneça a data no formato correto (YYYY-MM-DD).'], 400);
        }
    }    

    /**
     * @OA\Post(
     *     path="/api/isHolidayOrWeekend",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="date",
     *                     type="string"
     *                 ),
     *                 example={"date": "2024-03-09"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Check if a date is a holiday or a weekend")
     * )
     */
    public function isHolidayOrWeekend(Request $request){
        try {
            return $this->isHoliday($request) || $this->isWeekend($request);
        } catch (Exception $e) {
            return response()->json(['error' => 'Por favor, forneça a data no formato correto (YYYY-MM-DD).'], 400);
        }
    }
}
