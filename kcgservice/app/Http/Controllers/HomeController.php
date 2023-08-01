<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
 
        $myfile = fopen("zzzzz.txt", "w") or die("Unable to open file!");
        $txt = "John Doe\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        //return view('home');
    }

    public function home()
    {
        
       
      
        if (Auth::user()->role==1)
        {
            $token = hash('sha256', uniqid(microtime()));  
            $uid=Auth::user()->id;
            DB::unprepared("update users set token ='".$token."' where id =".$uid );
            setcookie("Authorization", $token, time()+3600);

            return  redirect('/backend/check.php');
       
        
        }

        if(Auth::user()->role==2)
        {

            $token = hash('sha256', uniqid(microtime()));  
            $uid=Auth::user()->id;
            $results = DB::select("SELECT  user_id, name, email, phone, package, words, used_words, remain_words, connection_points,  expire_date FROM accounts WHERE user_id=".$uid);
            if($results) return view('auth/home/index', compact($results));
            else {
                $data['title'] = '404';
                $data['name'] = 'Page not found';
                return response()->view('errors.404',$data,404);
            }



         }

        
    }
}
