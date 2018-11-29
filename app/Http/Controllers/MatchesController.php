<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Table;
use Session;
use DB;

class MatchesController extends Controller
{
	public function index($season) {
		$season = Season::find($season);
		$season_id = $season->id;
		$matches = Match::where('season_id', $season_id)->orderBy('round', 'asc')->get();
		return view('matches.index')->with('season', $season)->with('matches', $matches);
	}

	public function add($season) {
		$season = Season::find($season);
		return view('matches.add')->with('season', $season);
	}

	public function edit($season, $match) {
		$season = Season::find($season);
		$match = Match::find($match);

		return view('matches.edit')->with('season', $season)
									->with('match', $match);
	}

    public function show($season, $match) {
        $season = Season::find($season);
        $match = Match::find($match);
        return view('matches.show')->with('season', $season)
                                    ->with('match', $match);
    }

	public function update(Request $request) {

		$match = Match::find($request->input('match_id'));
		$match->team1 = $request->input('home');
		$match->team2 = $request->input('away');
		$match->round = $request->input('round');
		$match->date = $request->input('date');
		$match->save();

		return redirect()->route('matches.index', $request->input('season_id'));
	}

    public function save(Request $request) {
	    

        if ($request->input('home') == $request->input('away')) 
            Session::flash('error_teams', 'Jedna drużyna nie może być jednocześnie gospodarzem i gościem!');
        else {
            $match = new Match();
            $match->date = $request->input('date');
            $match->season_id = $request->input('season_id');
            $match->round = $request->input('round');
            $match->team1 = $request->input('home');
            $match->team2 = $request->input('away');
            $match->played = false;
            $match->final = ' ';
            $match->goals_team1 = 0;
            $match->goals_team2 = 0;
            $match->save();
        }


        return redirect()->route('matches.index', $request->input('season_id'));
    }

    public function delete($season, $match) {
    	$match = Match::find($match);
    	$match->delete();

    	return redirect()->route('matches.index', $season);
    }

    public function result($season, $match) {
    	$season = Season::find($season);
    	$match = Match::find($match);

    	return view('matches.result')->with('season', $season)
									->with('match', $match);
    }

    public function save_result(Request $request) {
    	$match = Match::find($request->input('match_id'));
    	$table_home = Table::where('team_id', $match->team_home->id)->where('season_id', $match->season->id)->first();
    	$table_away = Table::where('team_id', $match->team_away->id)->where('season_id', $match->season->id)->first();

    	if ($match->played == false) {
    		$table_home->matches +=1;
    		$table_away->matches +=1;
    		$table_home->scored_goals += $request->input('goals_home');
    		$table_away->scored_goals += $request->input('goals_away');
    		$table_home->lost_goals += $request->input('goals_away');
    		$table_away->lost_goals += $request->input('goals_home');

    		if ($request->input('goals_home') == $request->input('goals_away')) {
    			$table_home->points += 1;
    			$table_away->points += 1;
    			$table_home->draws += 1;
    			$table_away->draws += 1; 
    		}
    		if ($request->input('goals_home') > $request->input('goals_away')) {
    			$table_home->points += 3;
    			$table_home->wins += 1;
    			$table_away->loses += 1;
    		}
    		if ($request->input('goals_home') < $request->input('goals_away')) {
    			$table_away->points += 3;
    			$table_away->wins += 1;
    			$table_home->loses += 1;
    		}
    	}

    	$table_home->save();
    	$table_away->save();


    	$match->played = true;
        $match->final = $request->input('final');
    	$match->goals_team1 = $request->input('goals_home');
    	$match->goals_team2 = $request->input('goals_away');
    	$match->save();



    	return redirect()->route('matches.index', $request->input('season_id'));
    }
}
