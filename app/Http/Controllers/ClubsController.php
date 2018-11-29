<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Club;

class ClubsController extends Controller
{
	
	public function add() {
        
		return view('clubs.add');
	}    

	public function save(Request $request) {
		if(Input::hasFile('logo')) {
			$logo = Input::file('logo');
			$logo->move('images/logos', $logo->getClientOriginalName());
		}

    	$club = new Club();
    	$club->name = $request->input('name');
        $club->logo = $logo->getClientOriginalName();
    	$club->save();

        return redirect()->route('teams.add', $request->input('season_id'));
    }

    public function index() {
    	$clubs = Club::latest()->get();
    	return view('clubs.index')->with('clubs', $clubs);
    }

    public function show($club) {
		$club = League::find($club);
        return view('clubs.show')->with('club', $club);
    }

}
