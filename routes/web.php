<?php

use App\Models\League;
use App\Models\LeagueInfo;
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

Route::get('/league', function () {
    return view('league');
});
Route::post('/league' , function (Request $request){

    $request->validate([
        'players' => 'required',
        'players.*' => 'required',
        'numOfPlayers' => 'required',
        'leagueName' => 'required'
    ]);

    /* save League name in data base */
    $leagueName = \request('leagueName');
    $league = new League();
    $league->Name = $leagueName;
    $league->save();

    /* end of save */



    $numOfPlayers = \request('numOfPlayers');

    $allPlayers = \request('players');
    for($i = 0 ; $i < $numOfPlayers ; $i++){
        $player = new Player();
        $player->Name = $allPlayers[$i];
        //$player->save();

        $leagueInfo = new LeagueInfo();
        $leagueInfo->player()->associate(1);
        $leagueInfo->league()->associate(2);
        $leagueInfo->club()->associate(3);

        $leagueInfo->save();
    }




    var_dump($request->all());


    return ;
    var_dump(\request('players'));
    for($i = 0 ; $i < $numOfPlayers; $i++) {
        var_dump(\request('club'.$i));
    }

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
