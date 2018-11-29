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
    <li><a href="{{ route('matches.edit',[ $season, $match ]) }}">Szczegóły</a></li>
    @if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
    <li><a href="{{ route('matches.result', [ $season, $match ]) }}">Wynik</a></li>
    @endif
    <li class="active"><a href="{{ route('goals.index', [ $season, $match ]) }}">Strzelcy</a></li>
    <li><a href="{{ route('cards.index', [ $season, $match ]) }}">Kartki</a></li>
  </ul>
</div>  

@if ($match->played == false)
<div class="alert alert-info">
  Mecz nie został jeszcze rozegrany!
</div>
@else

<div style="float: left; width: 50%;">
<table class="table table-bordered">
  <thead>
  <th>
    {{$match->team_home->club->name}}
  </th>
  </thead>
  @if ($match->goals_team1 == 0)
  <tbody>
    <tr><td>Brak bramek</td></tr>
  </tbody>
  @else
  <tbody>
  @foreach ($match->goals as $goal)
  @if ($goal->player->team->id == $match->team_home->id)
  <tr>
    <td>{{$goal->player->firstname}} {{$goal->player->lastname}} {{$goal->time}}'
      @if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
      <button style="float: right;" class="btn btn-danger btn-xs" onclick="location.href='{{ route('goals.delete', $goal) }}'">Usuń</button>
      @endif
    </td>
  </tr>  
  @endif
  @endforeach
</tbody>
  @endif
</table>
</div>

<div style="float: right; width: 50%;">
<table class="table table-bordered">
  <thead>
  <th>
    {{$match->team_away->club->name}}
  </th>
  </thead>
  @if ($match->goals_team2 == 0)
  <tbody>
    <tr><td>Brak bramek</td></tr>
  </tbody>
  @else
  <tbody>
  @foreach ($match->goals as $goal)
  @if ($goal->player->team->id == $match->team_away->id)
  <tr>
    <td>{{$goal->player->firstname}} {{$goal->player->lastname}} {{$goal->time}}'
    @if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
    <button style="float: right;" class="btn btn-danger btn-xs" onclick="location.href='{{ route('goals.delete', $goal) }}'">Usuń</button>
    @endif
    </td>
  </tr>  
  @endif
  @endforeach
</tbody>
  @endif
</table>
</div>

@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))

@if ($match->goals_team1 != 0 && $match->goals_team1 > $goals_home)
<button style="float: left; clear: both;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal_home">Dodaj strzelca gospodarzy</button>
@endif
@if ($match->goals_team2 != 0 && $match->goals_team2 > $goals_away)
<button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal_away">Dodaj strzelca gości</button>
@endif

@endif
@endif

<!-- Modal -->
  <div class="modal fade" id="myModal_home" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dodaj strzelca gospodarzy</h4>
        </div>
        <div class="modal-body">
            <form action="{{route('goals.save')}}" class="form-group" method="post" enctype="multipart/form-data">
        <input name="_token" type="hidden" value="{{csrf_token()}}">
        <input name="season_id" type="hidden" value="{{$season->id}}">
        <input name="match_id" type="hidden" value="{{$match->id}}">
          <div class="form-group" class="col-sm-3">
              <label for="plr">Zawodnik:</label>
              <select class="form-control" name="player" id="plr" required="required">
              @foreach ($match->team_home->players as $player)
                  <option value="{{$player->id}}">{{$player->firstname}} {{$player->lastname}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group" class="col-sm-3">
            <label for="min">Minuta:</label>
            <input class="form-control" type="number" name="time" min="1" max="150" id="min" required="required">
          </div>
            <button type="submit" class="btn btn-success">Dodaj strzelca</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Modal -->
  <div class="modal fade" id="myModal_away" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dodaj strzelca gości</h4>
        </div>
        <div class="modal-body">
            <form action="{{route('goals.save')}}" class="form-group" method="post" enctype="multipart/form-data">
        <input name="_token" type="hidden" value="{{csrf_token()}}">
        <input name="season_id" type="hidden" value="{{$season->id}}">
        <input name="match_id" type="hidden" value="{{$match->id}}">
          <div class="form-group" class="col-sm-3">
              <label for="plr">Zawodnik:</label>
              <select class="form-control" name="player" id="plr">
              @foreach ($match->team_away->players as $player)
                  <option value="{{$player->id}}">{{$player->firstname}} {{$player->lastname}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group" class="col-sm-3">
            <label for="min">Minuta:</label>
            <input class="form-control" type="number" name="time" min="1" max="150" id="min">
          </div>
            <button type="submit" class="btn btn-success">Dodaj strzelca</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        </div>
      </div>
      
    </div>
  </div>



@endsection