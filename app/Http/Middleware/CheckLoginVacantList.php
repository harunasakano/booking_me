<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginVacantList
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //URLを他のログインユーザーのIDに変えても見られないように自分のIDにリダイレクト
        if (!($request->id == Auth::user()->id)) {
            return redirect()->route('vacant.index', ['id' => Auth::user()->id]);
        }
        return $next($request);
    }
}
