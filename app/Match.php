<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function teams() {
    	return $this->belongsToMany('App\Team');
    }

    public function season() {
    	return $this->belongsTo('App\Season');
    }

    public function goals() {
        return $this->hasMany('App\Goal');
    }

    public function cards() {
        return $this->hasMany('App\Card');
    }

    public function team_home()
	{
    return $this->belongsTo('App\Team','team1');
	}

	public function team_away()
{
    return $this->belongsTo('App\Team','team2');
}
}
