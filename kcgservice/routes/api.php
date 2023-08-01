<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\signcontroller;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/api/hashit',function(){
request()->validate([
'pwd'=>'required',
]);

return Hash::make(request('pwd'));
});

Route::post('/mirror',[signcontroller::class,'mirror']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/getlogin', 'App\Http\Controllers\Api\AuthController@getlogin');
    Route::post('/getlogout', 'App\Http\Controllers\Api\AuthController@getlogout');
  //  Route::post('/login', [AuthController::class, 'login']);
   // Route::post('/logout', [AuthController::class, 'logout']);
   
});

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('/trans',[signcontroller::class,'index']);
    Route::post('/ReadNum',[signcontroller::class,'ReadNum']);
    


});