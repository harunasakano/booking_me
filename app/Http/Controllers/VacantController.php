<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacant;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        $vacant = Vacant::all();
        $date_latest = $vacant->sortBy('date')->pluck('date');

        /* ここから */
        $date_of_first_last = [];
        $year_month = [];

        foreach ($date_latest as $date_value) {
            $year_month[] = date('Y-m', strtotime($date_value));
        }

        $remove_year_month = array_unique($year_month);
        $clean_year_month = array_values($remove_year_month);

        foreach (array_values($clean_year_month) as $year_month_v) {
            $date_of_first_last[$year_month_v]['first'] = date('D', strtotime('first day of ' . $year_month_v));
            $date_of_first_last[$year_month_v]['last'] = date('d', strtotime('last day of ' . $year_month_v));
        }

        $td_count = 0;
        $html = '';

        for ($i = 1; $i <= $date_of_first_last[$clean_year_month[0]]['last']; $i++) {
            if ($i == 1) {
                switch ($date_of_first_last[$clean_year_month[0]]['first']) {
                    case 'Mon':
                        $html =
                            "<tr><td class=" . ++$td_count . ">$i</td>";
                        break;

                    case 'Tue':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Wed':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Thu':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Fri':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Sat':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Sun':
                        "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;
                }

            } else {
                if ($i == 2) {
                    $td_count++;

                }
                if ($i !== 1 && $td_count % 7 !== 0) {

                    while ($td_count % 7 !== 0) {
                        $html .= "<td class=" . $td_count . ">" . $i . "</td>\n";
                        $td_count++;
                        if ($td_count % 7 !== 0) {
                            $i++;
                        }
                    }
                } else if ($i !== 1 && $td_count % 7 == 0) {
                    $html .= "<td class=" . $td_count . ">$i</td>\n</tr>\n<tr>";
                    ++$td_count;
                }
            }
        }

        dd($html);
        /* ここまで別ファイルに処理うつす */

        return view('vacant.index', compact('vacant', 'date_latest', 'date_of_first_last'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Vacant $vacant
     * @return void
     */
    public
    function create(Vacant $vacant)
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
    public
    function store(Request $request, Vacant $vacant)
    {

        $vacant->create([
            'date' => date('Y/m/d H:i D', (strtotime($request->date))),
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        //TODO vacantのindexページが完成したら登録完了後はそこに飛ばす
        return redirect()->route('user.show', ['user' => Auth::user()->id])->with('my_status', __('vacant.register_done'));
    }

    /**
     * Display the specified resource.
     *
     * @param $user_id
     * @param $vacant_id
     * @return \Illuminate\Http\Response
     */
    public
    function show($user_id, $vacant_id)
    {
        $vacant = Vacant::find($vacant_id);
        return view('vacant.shows', compact('vacant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user_id
     * @param $vacant_id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($user_id, $vacant_id)
    {
        $vacant_status = Vacant::VACANT_STATUS;
        $vacant = Vacant::find($vacant_id);

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
    public
    function update(Request $request, $user_id, $vacant_id)
    {

        Vacant::where('id', $vacant_id)
            ->update
            ([
                'date' => $request->date,
                'status' => $request->status,
            ]);

        //TODO vacantのindexページが完成したら登録完了後はそこに飛ばす
        return redirect()->route('user.show', ['user' => Auth::user()->id])->with('my_status', __('vacant.update_done'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
