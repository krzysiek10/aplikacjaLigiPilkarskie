<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function team() {
    	return $this->belongsTo('App\Team');
    }

    public function season() {
    	return $this->belongsTo('App\Season');
    }
}
