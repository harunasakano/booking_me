<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserVacantShareUrl;

class UserVacantShareUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $share_url_status = UserVacantShareUrl::SHARE_URL_STATUS;
        $user_vacant_share_url = UserVacantShareUrl::where('user_id', Auth::user()->id)->latest('updated_at')->first();
        return view('share_url.index',compact('user_vacant_share_url','share_url_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exit_user_url = UserVacantShareUrl::where('user_id', Auth::user()->id)->get();

        //既にURLが存在する場合は、indexへリダイレクト
        if ($exit_user_url->isNotEmpty()) {
            return redirect()->route('share_url.index', ['id' => Auth::user()->id]);
        } else {
            $share_url_status = UserVacantShareUrl::SHARE_URL_STATUS;
            return view('share_url.create', compact('share_url_status'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $share_url = substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, 48);
        $share_url_status = UserVacantShareUrl::SHARE_URL_STATUS;
        $status = array_search($request->status, $share_url_status);

        $share_url_obj = UserVacantShareUrl::create([
            'url' => $share_url,
            'status' => $status,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('share_url.index', ['id' => Auth::user()->id])->with('my_status', __('vacant.register_done'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user_id
     * @param $share_url_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $share_url_id)
    {
        $deleteObj = UserVacantShareUrl::find($share_url_id);
        $deleteObj->delete();

        return redirect()->route('user.show', ['user' => Auth::user()->id])->with('my_status',"共有URLを削除しました。");
    }
}
