@extends('layouts.app')
@section('content')

<h1>{{$team->season->league->name}}    <span style="font-size: 22px;">sezon: {{$team->season->name}}</span></h1>
<h3><img src="/images/logos/{{$team->club->logo}}" width="60px"> {{$team->club->name}}</h3>

<div style="padding-bottom: 10px;">
  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="{{ route('players.index', $team) }}">Zawodnicy</a></li>
    <li><a href="{{ route('teams.stats', $team) }}">Statystyki</a></li>
</div>  

<table class="table">
	<tr>
		<th>Nr</th>
		<th>Nazwisko</th>
		<th>Imię</th>
		<th>Pozycja</th>
	</tr>
	@foreach ($team->players as $player)
	<tr>
		<td>{{$player->number}}</td>
		<td>{{$player->lastname}}</td>
		<td>{{$player->firstname}}</td>
		<td>{{$player->position}}</td>
	</tr>
	@endforeach
</table>

@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
<button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Dodaj zawodnika</button>
@endif

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dodaj zawodnika</h4>
        </div>
        <div class="modal-body">
          <form class="form-group" action="{{route('players.save')}}" method="post">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <input type="hidden" name="team_id" value="{{$team->id}}">
              <div class="form-group" class="col-sm-4">
                <input type="text" name="firstname" class="form-control" placeholder="Imię" required="required">
              </div>
              <div class="form-group" class="col-sm-4">
                <input type="text" name="lastname" class="form-control" placeholder="Nazwisko" required="required">
              </div>
              <div class="form-group" class="col-sm-4">
                <select class="form-control" placeholder="Pozycja" name="position" required="required">
                  <option value="Bramkarz">Bramkarz</option>
                  <option value="Obrońca">Obrońca</option>
                  <option value="Pomocnik">Pomocnik</option>
                  <option value="Napastnik">Napastnik</option>
                </select>
              </div>
              <div class="form-group" class="col-sm-4">
                <input type="number" class="form-control" min="1" placeholder="Numer na koszulce" name="number" required="required">
              </div>
              <button type="submit" class="btn btn-success">Dodaj zawodnika</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        </div>
      </div>
      
    </div>
  </div>

@endsection