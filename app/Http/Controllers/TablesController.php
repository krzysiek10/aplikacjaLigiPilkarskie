<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Table;

class TablesController extends Controller
{
    public function show($season) {
    	
        $season = Season::find($season);
    	$tables = Table::where('season_id', $season->id)->orderBy('points', 'desc')->get();
    	$i = 0;
        return view('tables.show')->with('season', $season)
        							->with('i', $i)
        							->with('tables', $tables);
    }
}
