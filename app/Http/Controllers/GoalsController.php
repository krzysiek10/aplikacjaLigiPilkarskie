<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Match;
use App\Goal;

class GoalsController extends Controller
{
    public function index($season, $match) {
    	$season = Season::find($season);
    	$match = Match::find($match);

        $goals_home = 0;
        foreach ($match->goals as $goal) {
            if ($goal->player->team->id == $match->team_home->id)
                $goals_home++;
        }

        $goals_away = 0;
        foreach ($match->goals as $goal) {
            if ($goal->player->team->id == $match->team_away->id)
                $goals_away++;
        }

    	return view('goals.index')->with('match', $match)
							    	->with('season', $season)
                                    ->with('goals_home', $goals_home)
                                    ->with('goals_away', $goals_away);
    }

    public function season($season) {
    	$season = Season::find($season);
    	$goals = Goal::get();

    	

    	return view('goals.season')->with('goals', $goals)
							    	->with('season', $season);

    }

    public function delete($goal) {
        $goal = Goal::find($goal);
        $goal->delete();

        return redirect()->route('goals.index', [ $goal->match->season->id, $goal->match->id ] );
    } 

    public function save(Request $request) {
    	$all = $request->input('goals_team1') + $request->input('goals_team2');

    	$goal = new Goal();
    	$goal->player_id = $request->input('player');
    	$goal->match_id = $request->input('match_id');
    	$goal->time = $request->input('time');
    	$goal->save();

    	return redirect()->route('goals.index', [ $request->input('season_id'), $request->input('match_id')]);
    }

    public function update(Request $request) {
    	$match = Match::find($request->input('match_id'));
    	$all = $request->input('goals_team1') + $request->input('goals_team2');

    	for ($i=1; $i<=$all; $i++) {
    		$g = Goal::find(32);
    		$g->player_id = $request->input('player'.$i);
    		$g->save();
    	}
    }
}
