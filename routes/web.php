<?php

/*
Leagues
*/
Route::get('/leagues', [
	'uses' => 'LeaguesController@index',
	'as' => 'leagues.index'
]);
Route::post('/leagues/add', [
	'uses' => 'LeaguesController@add',
	'as' => 'leagues.add'
]);
Route::post('leagues/save', [
	'uses' => 'LeaguesController@save',
	'as' => 'leagues.save'
]);
Route::get('/leagues/{league}', [
	'uses' => 'LeaguesController@show',
	'as' => 'leagues.show'
]);
Route::get('/league/{league}/delete', [
	'uses' => 'LeaguesController@delete',
	'as' => 'leagues.delete'
]);

/*
Clubs
*/

Route::get('/clubs', 'ClubsController@index');
Route::get('/clubs/add', [
	'uses' => 'ClubsController@add',
	'as' => 'clubs.add'
]);
Route::post('clubs/save', [
	'uses' => 'ClubsController@save',
	'as' => 'clubs.save'
]);
Route::get('/clubs/{league}', [
	'uses' => 'ClubsController@show',
	'as' => 'clubs.show'
]);

/*
Teams
*/

Route::get('/seasons/{season}/teams', [
	'uses' => 'TeamsController@index',
	'as' => 'teams.index'
]);
Route::get('/season/{season}/teams/add', [
	'uses' => 'TeamsController@add',
	'as' => 'teams.add'
]);
Route::post('/teams/save', [
	'uses' => 'TeamsController@save',
	'as' => 'teams.save'
]);
Route::get('/teams/delete/{team}', [
	'uses' => 'TeamsController@delete',
	'as' => 'teams.delete'
]);
Route::get('/team/{team}', [
	'uses' => 'TeamsController@show',
	'as' => 'teams.show'
]);
Route::get('/team/{team}/stats', [
	'uses' => 'TeamsController@stats',
	'as' => 'teams.stats'
]);

/*
Seasons
*/
Route::post('/seasons/add', [
	'uses' => 'SeasonsController@add',
	'as' => 'seasons.add'
]);
Route::post('/seasons/save', [
	'uses' => 'SeasonsController@save',
	'as' => 'seasons.save'
]);
Route::get('/seasons/{season}', [
	'uses' => 'SeasonsController@show',
	'as' => 'seasons.show'
]);
Route::get('/season/{season}/delete', [
	'uses' => 'SeasonsController@delete',
	'as' => 'seasons.delete'
]);


/*
Matches
*/
Route::get('seasons/{season}/matches/', [
	'uses' => 'MatchesController@index',
	'as' => 'matches.index'
]);
Route::get('seasons/{season}/matches/add', [
	'uses' => 'MatchesController@add',
	'as' => 'matches.add'
]);
Route::get('seasons/{season}/matches/{match}/delete', [
	'uses' => 'MatchesController@delete',
	'as' => 'matches.delete'
]);
Route::get('seasons/{season}/matches/{match}/edit', [
	'uses' => 'MatchesController@edit',
	'as' => 'matches.edit'
]);
Route::get('seasons/{season}/matches/{match}', [
	'uses' => 'MatchesController@show',
	'as' => 'matches.show'
]);
Route::post('/matches/update', [
	'uses' => 'MatchesController@update',
	'as' => 'matches.update'
]);
Route::post('/matches/save', [
	'uses' => 'MatchesController@save',
	'as' => 'matches.save'
]);
Route::get('seasons/{season}/matches/{match}/result', [
	'uses' => 'MatchesController@result',
	'as' => 'matches.result'
]);
Route::post('seasons/matches/save_result', [
	'uses' => 'MatchesController@save_result',
	'as' => 'matches.save_result'
]);

/*
Players
*/
Route::get('team/{team}/players/', [
	'uses' => 'PlayersController@index',
	'as' => 'players.index'
]);
Route::get('team/{team}/player/add', [
	'uses' => 'PlayersController@add',
	'as' => 'players.add'
]);
Route::post('player/save', [
	'uses' => 'PlayersController@save',
	'as' => 'players.save'
]);
Route::get('team/{team}/player/{player}', [
	'uses' => 'PlayersController@show',
	'as' => 'players.show'
]);

/*
Tables
*/
Route::get('seasons/{season}/table/', [
	'uses' => 'TablesController@show',
	'as' => 'tables.show'
]);

/*
Goals
*/
Route::get('seasons/{season}/matches/{match}/goals', [
	'uses' => 'GoalsController@index',
	'as' => 'goals.index'
]);
Route::get('seasons/{season}/goals', [
	'uses' => 'GoalsController@season',
	'as' => 'goals.season'
]);
Route::get('goals/delete/{goal}', [
	'uses' => 'GoalsController@delete',
	'as' => 'goals.delete'
]);
Route::post('goals/save', [
	'uses' => 'GoalsController@save',
	'as' => 'goals.save'
]);
Route::post('goals/update', [
	'uses' => 'GoalsController@update',
	'as' => 'goals.update'
]);

/*
Cards
*/
Route::get('seasons/{season}/matches/{match}/cards', [
	'uses' => 'CardsController@index',
	'as' => 'cards.index'
]);
Route::post('cards/save', [
	'uses' => 'CardsController@save',
	'as' => 'cards.save'
]);
Route::get('cards/delete/{card}', [
	'uses' => 'CardsController@delete',
	'as' => 'cards.delete'
]);

/*
Users
*/
Route::get('users', [
	'uses' => 'UsersController@index',
	'as' => 'users.index'
]);
Route::get('users/{user}/setadmin', [
	'uses' => 'UsersController@set_admin',
	'as' => 'users.set_admin'
]);
Route::get('users/{user}/setuser', [
	'uses' => 'UsersController@set_user',
	'as' => 'users.set_user'
]);
Route::post('users/set_role', [
	'uses' => 'UsersController@set_role',
	'as' => 'users.set_role'
]);
Route::get('users/{user}/delete', [
	'uses' => 'UsersController@delete',
	'as' => 'users.delete'
]);

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
