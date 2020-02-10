<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacant;
use Illuminate\Support\Facades\Auth;

class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $vacant->create(['date' => $request->date,
            'status' => $request->status,
            'user_id' => Auth::user()->id
        ]);

        //TODO vacantのindexページが完成したら登録完了後はそこに飛ばす
        return redirect()->route('user.show', ['user' => Auth::user()->id])->with('my_status', __('vacant.register_done'));
    }

    /**
     * Display the specified resource.
     *
     * @param Vacant $vacant
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacant = Vacant::find($id);
        return view('vacant.shows', compact('vacant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
