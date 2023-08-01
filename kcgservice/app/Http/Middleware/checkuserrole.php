<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class checkuserrole
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
      
        if (Auth::user()->role==1)
        {
        
            return  redirect('/contracting/index.php');
       
        
        }

        if(Auth::user()->role==2)
        {

        return  redirect('/accountant/index.php');


         }

        if(Auth::user()->role==3)
         {

         return  redirect('/support/index.php');


         }
        return $next($request);
    }
}
