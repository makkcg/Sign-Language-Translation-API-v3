<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
        if(Auth::user()->role=='1')
        {
        return $next($request);
        }
        else {
            return redirect('/home')->with('messsage','you are not admin');

        }
    }
    else {
        return redirect('/login')->with('messsage','Log in Firstly');
    } 
    }
}
