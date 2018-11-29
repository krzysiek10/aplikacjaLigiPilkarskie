<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\League;

class SeasonsController extends Controller
{
    public function add(Request $request) {
    	$league_id = $request->input('league_id');
    	$league_name = $request->input('league_name');

    	return view('seasons.add')->with('league_id', $league_id)
    								->with('league_name', $league_name);
    }

    public function delete($season) {
        $season = Season::find($season);
        $season->delete();

        return redirect()->route('leagues.show', $season->league->id);
    }

    public function save(Request $request) {
    	$season = new Season();
    	$season->name = $request->input('name');
    	$season->league_id = $request->input('league');
    	$season->save();

        $league_id = $request->input('league');

        return redirect()->route('leagues.show', $league_id);
    }

    public function show($season) {
    	
        $season = Season::find($season);
        $league = League::find($season->league_id);
        return view('seasons.show')->with('season', $season)
        							->with('league', $league);
    }
}
