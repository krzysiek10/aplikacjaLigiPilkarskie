<?php

use Illuminate\Database\Seeder;
use App\Club;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$club = new Club();
    	$club->name = 'FC Barcelona';
    	$club->logo = 'barca.png';
    	$club->save();

    	$club = new Club();
    	$club->name = 'Sevilla';
    	$club->logo = 'sevilla.png';
    	$club->save();

    	$club = new Club();
    	$club->name = 'Real Madryt';
    	$club->logo = 'real.png';
    	$club->save();

    	$club = new Club();
    	$club->name = 'Villareal';
    	$club->logo = 'villareal.png';
    	$club->save();

    	$club = new Club();
    	$club->name = 'Real Sosiedad';
    	$club->logo = 'sosiedad.png';
    	$club->save();

    	$club = new Club();
    	$club->name = 'Malaga';
    	$club->logo = 'malaga.png';
    	$club->save();

    }
}
