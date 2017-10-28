<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GoogleApiController extends Controller {
	
    public function checkPublicHoliday(Request $request)
    {        
		$date = $request->input('check_date');
		$minDate = date("Y-m-d\TH:i:s", strtotime($date)) . "Z";
		$maxDate = date("Y-m-d\TH:i:s", strtotime("$date 23:59:59")) . "Z";

		$url = "https://www.googleapis.com/calendar/v3/calendars/id.indonesian%23holiday%40group.v.calendar.google.com/events?key=". config('app.app_key') ."&timeMin=$minDate&timeMax=$maxDate";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL verification
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result = curl_exec($ch);
		curl_close($ch);
		$res = json_decode($result);
				
		$result = $date . " : Hari Biasa";
		
		if (count($res->items) > 0) {
			$result = $date . " : " . $res->items[0]->summary;			
		}
		
		return Response()->json(array('result' => $result));
    }
}