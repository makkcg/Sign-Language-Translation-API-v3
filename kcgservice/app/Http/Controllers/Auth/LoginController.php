<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function authenticated(Request $request)
    {
        //var_dump($request);
     
        $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials)) {
        
            $em=$credentials["email"];
           $result= DB::select("SELECT id,role FROM users WHERE email='".$em."'");
           $uid=0;
           $role=0;
           
           if($result)
           {
            $uid=intval($result[0]->id);
            $role=intval($result[0]->role);
            
            Session::put('MyID', $result[0]->id);

           } 

           if ($role==1)
           {
               $token = hash('sha256', uniqid(microtime()));  
               $uid=Auth::user()->id;
               DB::unprepared("update users set token ='".$token."' where id =".$uid );
               setcookie("Authorization", $token, time()+3600);
   
               return  redirect('/backend/check.php');
          
           
           }
   
           if($role==2)
           {
   
              // $token = hash('sha256', uniqid(microtime()));  
             
               $results = DB::select("SELECT  user_id, name, email, phone, package, words, used_words, remain_words, connection_points,  expire_date FROM accounts WHERE user_id=".$uid);
               if($results) return view('auth/home/index', compact($results));
               else {
                   $data['title'] = '404';
                   $data['name'] = 'Page not found';
                   return response()->view('errors.404',$data,404);
               }
   
   
   
            }
   

            // Authentication passed...
            return view('auth/home/index');
        }
        
     
    }
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
