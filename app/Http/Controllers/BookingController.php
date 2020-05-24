<?php

namespace App\Http\Controllers;

use App\Models\UserVacantShareUrl;
use App\Models\Vacant;
use App\Service\GuestVacantCalendar;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function show($param,$req_year_month = 'default')
    {
        $user = UserVacantShareUrl::where('url', '=', $param)->get();
        if($user->isNotEmpty()){
            return $this->index($param,$user->pluck('user_id')[0],$req_year_month);
        };
    }

    public function index($param,$user_id, $req_year_month)
    {
        //guestでも同じように見られるようにする
        $vacant = Vacant::where('user_id','=',$user_id)->get();

        $date_latest = $vacant->sortBy('date')->pluck('date', 'id');
        $guest_vacant_calender = new GuestVacantCalendar;
        $data = $guest_vacant_calender->htmlExport($date_latest, $req_year_month);

        return view('guest.index', compact( 'data','param'));
    }
}
