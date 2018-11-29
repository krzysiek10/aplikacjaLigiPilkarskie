<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function players() {
        return $this->hasMany('App\Player');
    }
    
    public function club() {
    	return $this->belongsTo('App\Club');
    }

    public function matches() {
    	return $this->hasMany('App\Match');
    }

    public function season() {
    	return $this->belongsTo('App\Season');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
    public function table() {
        return $this->hasOne('App\Table');
    }

    public function match1()
    {
        return $this->hasMany('App\Match', 'team1');
    }
    public function match2()
    {
        return $this->hasMany('App\Match', 'team2');
    }

    public function otherTeam()
    {
        if($this->match1->id == $this->id) {
            return $this->match1;

        }
        return $this->match2;
    }
}
