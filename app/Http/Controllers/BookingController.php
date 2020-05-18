<?php

namespace App\Http\Controllers;

use App\Models\UserVacantShareUrl;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function show($param)
    {
        $user = UserVacantShareUrl::where('url', '=', $param)->get();
        dd($user);
    }
}
