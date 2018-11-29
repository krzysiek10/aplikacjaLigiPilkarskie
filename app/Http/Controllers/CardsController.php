<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Season;
use App\Card;
use Session;

class CardsController extends Controller
{
    public function index($season, $match) {
    	$season = Season::find($season);
    	$match = Match::find($match);

    	return view('cards.index')->with('match', $match)
							    	->with('season', $season);
    }

    public function save(Request $request) {
        $y = Card::where('player_id', $request->input('player'))->where('match_id', $request->input('match_id'))->where('card', 'Żółta')->count();
        $c = Card::where('player_id', $request->input('player'))->where('match_id', $request->input('match_id'))->where('card', 'Czerwona')->count();
        if ($y == 2 || $c == 1) Session::flash('error_cards', 'Ten zawodnik nie może otrzymać więcej kartek!');
        else {
            $card = new Card();
        	$card->player_id = $request->input('player');
        	$card->match_id = $request->input('match_id');
        	$card->card = $request->input('card');
        	$card->time = $request->input('time');
        	$card->save();

            $x = Card::where('player_id', $request->input('player'))->where('match_id', $request->input('match_id'))->where('card', 'Żółta')->count();

            if ($x==2) {
                $card = new Card();
                $card->player_id = $request->input('player');
                $card->match_id = $request->input('match_id');
                $card->card = 'Czerwona';
                $card->time = $request->input('time');
                $card->save();
            }
        }

    	return redirect()->route('cards.index', [ $request->input('season_id'), $request->input('match_id')]);
    }

    public function delete($card) {
        $card = Card::find($card);
        $card->delete();

        return redirect()->route('cards.index', [ $card->match->season->id, $card->match->id ] );
    } 
}
