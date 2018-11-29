<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Season;
use Auth;

class LeaguesController extends Controller
{
    public function add() {
    	return view('leagues.add');
    }

    public function delete($league) {
        $league = League::find($league);
        $league->delete();

        return redirect('/');
    }

    public function save(Request $request) {
    	$league = new League();
    	$league->name = $request->input('name');
    	$league->save();

        return redirect('/');
    }

    public function index() {

        // if (Auth::check()) {
        //     $user_id = Auth::user()->id;
             $leagues = League::latest()->get();
        // }
        // else {
        //     return redirect('login');
        // }    	

    	return view('leagues.index')->with('leagues', $leagues);
    }

    public function show($league) {
    	
        $league = League::find($league);
        $league_id = $league->id;
        $seasons = Season::where('league_id', $league_id)->latest()->get();
        return view('leagues.show')->with('league', $league)
                                    ->with('seasons', $seasons);
    }
}
