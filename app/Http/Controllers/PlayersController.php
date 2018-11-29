<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Player;
use App\Team;


class PlayersController extends Controller
{
    public function index($team) {
		$team = Team::find($team);
		return view('players.index')->with('team', $team);
	}

    public function save(Request $request) {
    	$player = new Player();
    	$player->firstname = $request->input('firstname');
    	$player->lastname = $request->input('lastname');
    	$player->position = $request->input('position');
    	$player->number = $request->input('number');
    	$player->team_id = $request->input('team_id');
    	$player->save();

    	return redirect()->route('players.index', $request->input('team_id'));
    }

}
