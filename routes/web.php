<?php

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

Route::post('/league/{id}' , function ($id){

    $numOfMatches = count(\request('player')) / 2;
    $players = \request('player');
    $resultOfPlayers = \request('resPlayers');
    var_dump($resultOfPlayers);
//    $resultOfPlayer2 = \request('resPlayer2');
    echo "<br>";

    for($i = 0 ; $i < count($players) ; $i+=2)
    {
        $matchInserted = true;
        if(isset($resultOfPlayers[$i]) && $resultOfPlayers[$i+1]  ) // check if user enter the result or not
        {

            $player1Match = Match::where('player1' , $players[$i] )->get(); // find matches belong to player one
            foreach ($player1Match as $player){ // loop throw all  matches to sure that we will insert new match not old
                if($player->player2 == $players[$i+1]){
                    $matchInserted = false; // boolean variable to check if match is new or old
                    break;
                }
            }
            if($matchInserted) {
                // insert new match to data base with all data
                $match = new Match();
                $match->player1 = $players[$i];
                $match->player2 = $players[$i + 1];
                $match->result1 = $resultOfPlayers[$i];
                $match->result2 = $resultOfPlayers[$i + 1];
                $match->league_id = $id;
                $match->save();

                // update player data with new results
                $player1 = Player::findOrFail($players[$i]);
                $player2 = Player::findOrFail($players[$i+1]);

                $player1->MP += 1;
                $player2->MP += 1;

                $player1->GF += $resultOfPlayers[$i];
                $player1->GA += $resultOfPlayers[$i+1];
                $player1->GD += $resultOfPlayers[$i] - $resultOfPlayers[$i+1];

                $player2->GF += $resultOfPlayers[$i+1];
                $player2->GA += $resultOfPlayers[$i];
                $player2->GD += $resultOfPlayers[$i+1] - $resultOfPlayers[$i];


                if($resultOfPlayers[$i] > $resultOfPlayers[$i+1]){
                    $player1->W += 1;
                    $player2->L += 1;
                    $player1->Pts += 3;

                }elseif($resultOfPlayers[$i] < $resultOfPlayers[$i+1]){
                    $player2->W += 1;
                    $player1->L += 1;
                    $player2->Pts += 3;
                }else{
                    $player1->D += 1;
                    $player2->D += 1;
                    $player1->Pts += 1;
                    $player2->Pts += 1;
                }
                $player1->save();
                $player2->save();
            }

            //echo $player1->Name . " " . $resultOfPlayers[$i] .  " VS " . $player2->Name . " " . $resultOfPlayers[$i+1]. "<br>";
        }
    }

    var_dump($players);
    echo "<br>";
    var_dump(\request('resPlayer1'));
    echo "<br>";
    var_dump(\request('resPlayer2'));

    return redirect('/league/' . $id);

});
Route::get('/league/{id}', function ($id) {

    $league = League::findOrFail($id);

    $AllPlayers = Player::orderBy('Pts','DESC')->orderBy('GD' , 'DESC')->orderBy('GF' , 'DESC')->get();

    $leaguePlayers = $league->player;

    $finalPlayers = [];
    foreach ($AllPlayers as $player ){
        foreach ($leaguePlayers as $leaguePlayer){
            if($player->id == $leaguePlayer->id){
                array_push($finalPlayers,$player);
                break;
            }
        }
    }
    $allMatches = [];
    //dd($leaguePlayers);
    //dd($leaguePlayers);
    for ($i = 0 ; $i < count($leaguePlayers) ; $i++){
        for ($j = $i+1 ; $j < count($leaguePlayers)  ; $j++){
            $match1 = Match::where('player1' ,  '=' , $leaguePlayers[$i]->id)->where('player2' , '=' , $leaguePlayers[$j]->id )->get();
            $match2 = Match::where('player1' ,  '=' , $leaguePlayers[$j]->id)->where('player2' , '=' , $leaguePlayers[$i]->id )->get();
//            echo $leaguePlayers[$i]->id . "<br>";
//            echo $leaguePlayers[$j]->id . "<br>";
//            var_dump($match1);
//            echo "<br>";
//            var_dump($match2);
            // dd($match);
            // echo $finalPlayers[$i]->id . "<br>";
            // echo $finalPlayers[$j]->id . "<br>";
            if(count($match1) > 0) {
                array_push($allMatches, $match1);
            }else{
                array_push($allMatches, $match2);
            }
        }
    }
    //dd($allMatches);
    //dd($allMatches[0][0]->result1);

    //dd($finalPlayers);
    //dd($AllPlayers);
    //dd($leaguePlayers);
    return view('league' , ['players' => $finalPlayers , 'leaguePlayers' => $leaguePlayers , 'allMatches' => $allMatches , 'league' => $league]);
});
Route::post('/' , function (Request $request){

    $request->validate([
        'players' => 'required',
        'players.*' => 'required',
        'numOfPlayers' => 'required|numeric|min:3',
        'leagueName' => 'required'
    ]);

    /* save League name in data base */
    //$leagueName = \request('leagueName');
//    $league = new League();
//    $league->Name = $leagueName;
//    $league->save();

    /* end of save */


//    $player = new Player();
//    $playerName = \request('players')[0];
//    $player->Name = $playerName;
//    $player->save();
//
////    $leagueObj = League::findOrFail(1);
//
//
//    $player->league()->save(new League(["Name" => $leagueName]));
//    $player->club()->save(new Club(["Name" => "Arsenal" , "path" => "a"]));


    $numOfPlayers = \request('numOfPlayers');

    $allPlayers = \request('players');
    $league = new League();
    $sameLeague = new League();
    $leagueName = \request('leagueName');
    $leagueId = 0;
    for($i = 0 ; $i < $numOfPlayers ; $i++) {
        $player = new Player();
        $player->Name = $allPlayers[$i];
        $player->save();

        if($i == 0){
            $league->Name = $leagueName;
            $league->save();

        }else{
            $leagueTemp = League::where('Name' , $leagueName)->take(1)->get();
            $league = League::findOrFail($leagueTemp[0]->id);
            $leagueId = $leagueTemp[0]->id;
            error_log($leagueTemp[0]->id);
        }

        $clubName = \request('club'.$i);
        $clubTemp = Club::where('Name' , $clubName)->take(1)->get();

        $club = Club::findOrFail($clubTemp[0]->id);

        $player->club()->save($club);
        $player->league()->save($league);
    }

//    $player = Player::findOrFail(1);
//    $league = League::findOrFail(2);
////    $leagueObj = League::findOrFail(1);
//
//
//    $player->league()->save($league);
    //$player->club()->save(new Club(["Name" => "Arsenal" , "path" => "a"]));




//    $numOfPlayers = \request('numOfPlayers');
//
//    $allPlayers = \request('players');
//    for($i = 0 ; $i < $numOfPlayers ; $i++){
//        $player = new Player();
//        $player->Name = $allPlayers[$i];
//        //$player->save();
//
//
//        $clubName = \request('club'.$i);
//        error_log($clubName);
//        $club = Club::findOrFail(2);
//
//
//        $leagueInfo = new LeagueInfo();
//        $player->leagueInfo()->save($club);
        /*$leagueInfo->league()->associate($league);
        $leagueInfo->club()->associate($club);

        $leagueInfo->save();*/
//    }




    var_dump($request->all());

    var_dump(\request('players'));
    for($i = 0 ; $i < $numOfPlayers; $i++) {
        var_dump(\request('club'.$i));
    }

    //echo " Echo " . $leagueId ;
    return redirect('/league/'. $leagueId);

});
Route::get('/searchLeague' , function (){
   $leagueId = \request('searchedLeagueId');
    return redirect('/league/'.$leagueId);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
