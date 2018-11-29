<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function league() {
    	return $this->belongsTo('App\League');
    }

        public function teams() {
    	return $this->HasMany('App\Team');
    }

     public function matches() {
    	return $this->hasMany('App\Match');
    }

     public function tables() {
    	return $this->hasMany('App\Table');
    }


}
