@extends('layouts.app')

@section('content')

<h1>{{$season->league->name}}    <span style="font-size: 22px;">sezon: {{$season->name}}</span></h1>



<div style="padding-bottom: 10px;">
	<ul class="nav nav-tabs nav-justified">
    <li><a href="{{ route('teams.index', $season) }}">Drużyny</a></li>
    <li class="active"><a href="{{ route('matches.index', $season) }}">Terminarz i wyniki</a></li>
    <li><a href="{{ route('tables.show', $season) }}">Tabela</a></li>
  </ul>
</div>	

@if (Session::has('error_teams'))
  <div class="alert alert-danger card">
    {{Session::get('error_teams')}}
  </div>
@endif
	
<table class="table">
	<tr>
		<th width="7%">Kolejka</th>
		<th style="text-align: center;">Gospodarze</th>
		<th style="text-align: center;">Wynik</th>
		<th style="text-align: center;">Goście</th>
		<th style="text-align: center;">Data</th>
		@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
		<th></th>
		@endif
		<th></th>
	</tr>
	@foreach ($matches as $match)
	<tr>
		<td style="text-align: center;">{{$match->round}}</td>
		
		<td style="text-align: center;"><img src="/images/logos/{{$match->team_home->club->logo}}" width="30px"> {{$match->team_home->club->name}}</td>
		<td style="text-align: center;">
			@if ($match->played == false)
				- : -
			@else
				{{$match->goals_team1}} : {{$match->goals_team2}}
			@endif
		</td>
		<td style="text-align: center;"><img src="/images/logos/{{$match->team_away->club->logo}}" width="30px"> {{$match->team_away->club->name}}</td>
		
		<td style="text-align: center;">{{$match->date}}</td>
		@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
		<td><button class="btn btn-primary" onclick="location.href='{{ route('matches.show', [ $season, $match ]) }}'">Edytuj</button></td>
		<td><button class="btn btn-danger" onclick="location.href='{{ route('matches.delete', [ $season, $match ]) }}'">Usuń</button></td>
		@else
		<td><button class="btn btn-default" onclick="location.href='{{ route('matches.show', [ $season, $match ]) }}'">Szczegóły meczu</button></td>
		@endif
	</tr>
	@endforeach
</table>

@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Dodaj mecz</button>
@endif

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dodaj mecz</h4>
        </div>
        <div class="modal-body">
          	<form action="{{route('matches.save')}}" class="form-group" method="post" enctype="multipart/form-data">
				<input name="_token" type="hidden" value="{{csrf_token()}}">
				<input name="season_id" type="hidden" value="{{$season->id}}">
					<div class="form-group" class="col-sm-3">
				    	<input class="form-control" type="number" min="1" name="round" id="r" placeholder="Nr kolejki" required="required">
				  	</div>
					<div class="form-group" class="col-sm-3">
					    <select class="form-control" name="home" required="required">
							@foreach ($season->teams as $team)
					  			<option value="{{$team->id}}">{{$team->club->name}}</option>
					  		@endforeach
					  	</select>
					</div>
				  	<div class="form-group" class="col-sm-3">
				    	<select class="form-control" name="away" required="required">
							@foreach ($season->teams as $team)
								<option value="{{$team->id}}">{{$team->club->name}}</option>
							@endforeach
						</select>
				  	</div>
					<div class="form-group" class="col-sm-3">
						<input class="form-control" type="date" name="date" required="required">
				  	</div>
				  	<button type="submit" class="btn btn-success">Dodaj mecz</button>
				</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        </div>
      </div>
      
    </div>
  </div>




@endsection