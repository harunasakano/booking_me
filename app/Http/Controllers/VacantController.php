<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacant;
use Illuminate\Support\Facades\Auth;
use App\Service\VacantCalendar;

class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $user_id
     * @param $req_year_month
     * @return \Illuminate\Http\Response
     */
    public function index($user_id, $req_year_month = 'default')
    {
        $all_year_month = [];
        $vacant = Vacant::all();

        $date_latest = $vacant->sortBy('date')->pluck('date', 'id');
        $vacant_calender = new VacantCalendar;
        $data = $vacant_calender->htmlExport($date_latest, $req_year_month);

        return view('vacant.index', compact('vacant', 'date_latest', 'data', 'year_month'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Vacant $vacant
     * @return void
     */
    public function create(Vacant $vacant)
    {
        $vacant_status = Vacant::VACANT_STATUS;
        return view('vacant.create', compact('vacant', 'vacant_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Vacant $vacant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Vacant $vacant)
    {
        $vacant_obj = $vacant->create([
            'date' => date('Y/m/d H:i D', (strtotime($request->date))),
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        $year_month_param = date('Y_m', strtotime($vacant_obj->date));

        return redirect()->route('year_month_vacant', ['id' => Auth::user()->id, 'req_year_month' => $year_month_param])->with('my_status', __('vacant.register_done'));
    }

    /**
     * Display the specified resource.
     *
     * @param $user_id
     * @param $vacant_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $vacant_id)
    {
        $vacant = Vacant::find($vacant_id);
        return view('vacant.shows', compact('vacant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param $user_id
     * @param $vacant_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $user_id, $vacant_id)
    {
        $vacant_status = Vacant::VACANT_STATUS;
        $vacant = Vacant::find($vacant_id);

        if ($request->session()->has('vacant_date')) {
            $request->session()->forget('vacant_date');
        }

        $vacant_old_date = rtrim(preg_replace('/[a-zA-Z]/', '', $vacant->date));
        $request->session()->put('vacant_old_date', $vacant_old_date);

        return view('vacant.edit', compact('vacant', 'vacant_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $user_id
     * @param $vacant_id
     * @return void
     */
    public function update(Request $request, $user_id, $vacant_id)
    {
        $updateObj = Vacant::find($vacant_id);
        $updateObj->date = $request->date;
        $updateObj->status = $request->status;

        $updateObj->save();

        $year_month_param = date('Y_m', strtotime($updateObj->date));

        return redirect()->route('year_month_vacant', ['id' => Auth::user()->id, 'req_year_month' => $year_month_param])->with('my_status', __('vacant.update_done'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user_id
     * @param $vacant_id
     * @return void
     */
    public function destroy($user_id, $vacant_id)
    {
        $deleteObj = Vacant::find($vacant_id);
        $delete_date_message = $deleteObj->date;
        $deleteObj->delete();

        return redirect()->route('year_month_vacant', ['id' => Auth::user()->id])->with('my_status', $delete_date_message . " を、削除しました。");
    }
}
