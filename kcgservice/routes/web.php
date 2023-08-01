<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\Api\signcontroller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/api/hashit',function(){
    request()->validate([
    'pwd'=>'required',
    ]);
    
    return Hash::make(request('pwd'));
    });
      */  


    Route::get('/myhome', function () {
        
        return view('myhome');
    });
/*
Route::get('/clearcache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
     return view('welcome');
});

*/
Route::get('/', function () {
   // Auth::logout();
    return view('welcome');
});



Auth::routes();
//Route::get('/home', [App\Http\Controllers\CustomAuthcontroller::class, 'userrole'])->middleware('checkuserrole');
//Route::get('/HOME', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('/home', [HomeController::class,'home'])->name('home');
Route::get('/about', [AccountsController::class, 'about'])->name('about');
Route::get('/contacts', [AccountsController::class,'contacts'])->name('contacts');
Route::get('/profile', [AccountsController::class,'profile'])->name('profile');
Route::get('/translatePage', [AccountsController::class,'translatePage'])->name('translatePage');
Route::get('/news', [AccountsController::class,'news'])->name('news');
Route::get('Api/transit', [signcontroller::class,'transit'])->name('transit');




