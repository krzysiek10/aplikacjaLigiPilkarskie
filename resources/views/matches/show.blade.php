@extends('layouts.app')

@section('content')

<h1>{{$season->league->name}}    <span style="font-size: 22px;">sezon: {{$season->name}}</span></h1>  

<h6><a href="{{route('matches.index', $season)}}"><-powrót do terminarza</a></h6>

@if ($match->played == false)
<h3>{{$match->team_home->club->name}} <img src="/images/logos/{{$match->team_home->club->logo}}" width="30px"> - : - <img src="/images/logos/{{$match->team_away->club->logo}}" width="30px"> {{$match->team_away->club->name}}</h3>
@else
<h3>{{$match->team_home->club->name}} <img src="/images/logos/{{$match->team_home->club->logo}}" width="30px"> {{$match->goals_team1}} : {{$match->goals_team2}} <img src="/images/logos/{{$match->team_away->club->logo}}" width="30px"> {{$match->team_away->club->name}}</h3>
@endif

<div style="padding-bottom: 10px;">
	<ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="{{ route('matches.edit',[ $season, $match ]) }}">Szczegóły</a></li>
    @if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
    <li><a href="{{ route('matches.result', [ $season, $match ]) }}">Wynik</a></li>
    @endif
    <li><a href="{{ route('goals.index', [ $season, $match ]) }}">Strzelcy</a></li>
    <li><a href="{{ route('cards.index', [ $season, $match ]) }}">Kartki</a></li>
  </ul>
</div>	

@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
	
<form action="{{route('matches.update')}}" method="post" enctype="multipart/form-data">
	<input name="_token" type="hidden" value="{{csrf_token()}}">
	<input name="match_id" type="hidden" value="{{$match->id}}">
	<input name="season_id" type="hidden" value="{{$season->id}}">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style="text-align: center;">Nr kolejki</th>
      <th scope="col" style="text-align: center;">Gospodarze</th>
      <th scope="col" style="text-align: center;">Goście</th>
      <th scope="col" style="text-align: center;">Data</th>
    </tr>
  </thead>
  <tbody>
  	<td>
  		<input class="form-control" type="number" min="1" name="round" id="r" value="{{$match->round}}" required="required">
  	</td>
  	<td>
  		<select class="form-control" name="home" required="required">
			<option value="{{$match->team_home->id}}" selected="selected">{{$match->team_home->club->name}}</option>
			@foreach ($season->teams as $team)		  			
				<option value="{{$team->id}}">{{$team->club->name}}</option>
			@endforeach
		</select>
  	</td>
  	<td>
  		<select class="form-control" name="away" required="required">
			<option value="{{$match->team_away->id}}" selected="selected">{{$match->team_away->club->name}}</option>
			@foreach ($season->teams as $team)		 	
	 			<option value="{{$team->id}}">{{$team->club->name}}</option>
			@endforeach
			  	</select>
  	</td>
  	<td>
  		<input class="form-control" type="date" name="date" value="{{$match->date}}" required="required">
  	</td>
  </tbody>
  

</table>	
<div class="col-sm-4">
	<button class="btn btn-primary" class="form-control">Zapisz</button>
</div>
</form>		

@else

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style="text-align: center;">Nr kolejki</th>
      <th scope="col" style="text-align: center;">Gospodarze</th>
      <th scope="col" style="text-align: center;">Goście</th>
      <th scope="col" style="text-align: center;">Data</th>
    </tr>
  </thead>
  <tbody>
    <td style="text-align: center;">{{$match->round}}</td>
    <td style="text-align: center;">{{$match->team_home->club->name}}</td>
    <td style="text-align: center;">{{$match->team_away->club->name}}</td>
    <td style="text-align: center;">{{$match->date}}</td>
  </tbody>
</table>  
@if ($match->played == true)
Mecz zakończył się: {{$match->final}}
@endif

@endif

@endsection