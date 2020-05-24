<?php

namespace App\Http\Controllers;

use App\Models\UserVacantShareUrl;
use App\Models\Vacant;
use App\Service\VacantCalendar;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function show($param)
    {
        $user = UserVacantShareUrl::where('url', '=', $param)->get();

        if($user->isNotEmpty()){
            $this->index(4);
        };
    }

    public function index($user_id, $req_year_month = 'default')
    {
        //guestでも同じように見られるようにする
        $vacant = Vacant::all();

        dd($vacant);

        $date_latest = $vacant->sortBy('date')->pluck('date', 'id');
        $vacant_calender = new VacantCalendar;
        $data = $vacant_calender->htmlExport($date_latest, $req_year_month);

        dd($data);

        return view('vacant.index', compact('vacant', 'date_latest', 'data', 'year_month'));
    }
}
