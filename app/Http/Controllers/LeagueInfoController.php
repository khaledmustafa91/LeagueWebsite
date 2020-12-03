<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\League;
use App\Models\Match;
use App\Models\Player;
use Illuminate\Http\Request;

class LeagueInfoController extends Controller
{
    public function insertMatch($id){
        $numOfMatches = count(\request('player')) / 2;
        $players = \request('player');
        $resultOfPlayers = \request('resPlayers');

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

            }
        }

        return redirect('/league/' . $id);
    }
    public function findLeague($id){
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
        for ($i = 0 ; $i < count($leaguePlayers) ; $i++){
            for ($j = $i+1 ; $j < count($leaguePlayers)  ; $j++){
                $match1 = Match::where('player1' ,  '=' , $leaguePlayers[$i]->id)->where('player2' , '=' , $leaguePlayers[$j]->id )->get();
                $match2 = Match::where('player1' ,  '=' , $leaguePlayers[$j]->id)->where('player2' , '=' , $leaguePlayers[$i]->id )->get();
                if(count($match1) > 0) {
                    array_push($allMatches, $match1);
                }else{
                    array_push($allMatches, $match2);
                }
            }
        }
        return view('league' , ['players' => $finalPlayers , 'leaguePlayers' => $leaguePlayers , 'allMatches' => $allMatches , 'league' => $league]);

    }
    public function makeLeague(Request $request){
        $request->validate([
            'players' => 'required',
            'players.*' => 'required',
            'numOfPlayers' => 'required|numeric|min:3',
            'leagueName' => 'required'
        ]);

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

        return redirect('/league/'. $leagueId);
    }
    public function searchLeague(){
        $leagueId = \request('searchedLeagueId');
        return redirect('/league/'.$leagueId);
    }

}
