<?php

use App\Http\Controllers\LeagueInfoController;
use App\Models\Club;
use App\Models\League;
use App\Models\LeagueInfo;
use App\Models\Match;
use App\Models\Player;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile/{id}', function ($id) {
    return view('profile');
});

Route::post('/league/{id}' , [LeagueInfoController::class,'insertMatch']);
Route::get('/league/{id}', [LeagueInfoController::class,'findLeague']);

Route::post('/' , [LeagueInfoController::class,'makeLeague']);

Route::get('/searchLeague' , [LeagueInfoController::class,'searchLeague']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
