<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Club;
use App\Season;
use App\Table;
use DB;

class TeamsController extends Controller
{
	public function index($season) {
		$season = Season::find($season);
		return view('teams.index')->with('season', $season);
	}

    public function add($season) {
        $season = Season::find($season);
		$clubs = Club::orderBy('name', 'desc')->get();
		return view('teams.add')->with('season', $season)
								->with('clubs', $clubs);
	}

    public function delete($team) {
        $team = Team::find($team);
        $team->delete();

        return redirect()->route('teams.index', $team->season->id);
    }    

	public function save(Request $request) {
    	$team = new Team();
    	$team->club_id = $request->input('club_id');
        $team->season_id = $request->input('season_id');
    	$team->save();

    	$season_id = $request->input('season_id');

    	$table = new Table();
    	$table->team_id = $team->id;
        $table->season_id = $season_id;
    	$table->points = 0;
    	$table->matches = 0;
    	$table->wins = 0;
    	$table->draws = 0;
    	$table->loses = 0;
    	$table->scored_goals = 0;
    	$table->lost_goals = 0;
    	$table->save();

        return redirect()->route('teams.index', $season_id);
    }

    public function show($team) {
        $team = Team::find($team);
        return view('teams.show')->with('team', $team);
    }

    public function stats($team) {
        $team = Team::find($team);

        $w = $team->table->wins;
        $d = $team->table->draws;
        $l = $team->table->loses;
        $m = $team->table->matches;

        if ($team->table->matches == 0) {
            $wins = 0;
            $draws = 0;
            $loses = 0;
        }
        else {

            $wins = round($w*100/$m,2);
            $draws = round($d*100/$m,2);
            $loses = round($l*100/$m,2);
        }                               
        return view('teams.stats')->with('team', $team)
                                        ->with('wins', $wins)
                                        ->with('draws', $draws)
                                        ->with('loses', $loses); 
    }
}
