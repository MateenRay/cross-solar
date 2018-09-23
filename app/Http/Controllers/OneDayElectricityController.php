<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use Illuminate\Http\Request;
use Response;
use Validator;

class OneDayElectricityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'panel_serial' => 'required | size:15',
        ]);

        if ($validator->fails()) {
            return Response::json($validator->errors()->all(), 422);
        }

        $panel = Panel::where('serial', $request->panel_serial)->first();
        $entries = Panel::find($panel->id)->oneHourElectricities;
        $dates = [];
        foreach ($entries as $e) {
            $dates[] = date('Y-m-d', strtotime($e->hour));
        }
        $actualDates[] = array_unique($dates);
        foreach ($actualDates[0] as $date) {
            $year = date('Y', strtotime($date));
            $month = date('F', strtotime($date));
            $day = date('d', strtotime($date));
            $data [] = $this->historicDataByDate($date, $panel->id);

        }
        return Response::json($data, 200);
    }

    public function historicDataByDate($date, $panelId)
    {
        $day = $date;
        $sum = 0;
        $count = 0;
//        return $entries = Panel::find($panelId)->oneHourElectricities->where('hour','LIKE','%'.$date.'%');
        $entries = \DB::table('one_hour_electricities')->whereDate('hour', $date)->get();

        foreach ($entries as $key => $value) {
            $kw[] = $value->kilowatts;
            $sum += $value->kilowatts;
            $count++;

        }
        $min = min($kw);
        $max = max($kw);
        $average = (double) ($sum / $count);
        $data = [
            'day' => $day,
            'sum' => $sum,
            'min' => $min,
            'max' => $max,
            'average' => $average
        ];
        return $data;
    }
}
