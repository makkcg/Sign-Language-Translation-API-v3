<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountsController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function show(accounts $accounts)
    {
        //

    }

    public function AccountData()
    {
        $accounts =Accounts::where('user_id',  auth()->user()->id);
        return view('customers.index',compact('accounts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function edit(accounts $accounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, accounts $accounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function destroy(accounts $accounts)
    {
        //
    }

    public function about()
    {

        /*
        $uid=Auth::user()->id;
        $results = DB::select("SELECT  user_id, name, email, phone, package, words, used_words, remain_words, connection_points,  expire_date FROM accounts WHERE user_id=".$uid);
        if($results) return view('auth/home/about', compact($results));
        else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }
        */
        return view('auth/home/about');
    }

    public function contacts()
    {
         /*
       $uid=Auth::user()->id;
        $results = DB::select("SELECT  user_id, name, email, phone, package, words, used_words, remain_words, connection_points,  expire_date FROM accounts WHERE user_id=".$uid);
        if($results) return view('auth/home/contacts', compact($results));
        else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }
        */
        return view('auth/home/contacts');
        
    }

    public function profile()
    {

        $uid=Session::get('MyID');
        $accounts = DB::select("SELECT  user_id, name, email, phone, package, words, used_words, remain_words, connection_points,  expire_date FROM accounts WHERE user_id=".$uid);
        if($accounts) return view('auth/home/profile', compact('accounts'));
        else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }
        //
    }

    public function news()
    {

        //$uid=Auth::user()->id;
        $news = DB::select("SELECT title,report FROM news");
        if($results) return view('auth/home/news', compact($news));
        else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }
        //
    }

    public function translatePage()
    {

        $uid=Session::get('MyID');
  
        $results = DB::select("SELECT  user_id, name, email, phone, package, words, used_words, remain_words, connection_points,  expire_date FROM accounts WHERE user_id=".$uid);
        if($results) return view('auth/home/translatePage', compact('results'));
        else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }
        //
    }

}
