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
    <li><a href="{{ route('goals.index', [ $season, $match ]) }}">Strzelcy</a></li>
    <li class="active"><a href="{{ route('cards.index', [ $season, $match ]) }}">Kartki</a></li>
  </ul>
</div>  

@if ($match->played == false)
<div class="alert alert-info">
  Mecz nie został jeszcze rozegrany!
</div>
@else

@if (Session::has('error_cards'))
  <div class="alert alert-danger card">
    {{Session::get('error_cards')}}
  </div>
@endif

<div style="float: left; width: 50%;">
<table class="table table-bordered">
  <thead>
  <th>
    {{$match->team_home->club->name}}
  </th>
  </thead>
  <tbody>
  @foreach ($match->cards as $card)
  @if ($card->player->team->id == $match->team_home->id)
  <tr>
    <td>
      @if ($card->card == 'Żółta')
      <img src="/images/yellowcard.png" width="12px">&nbsp;
      @else
      <img src="/images/redcard.png" width="12px">&nbsp;
      @endif
      {{$card->player->firstname}} {{$card->player->lastname}}&nbsp;
      {{$card->time}}'
      @if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
      <button style="float: right;" class="btn btn-danger btn-xs" onclick="location.href='{{ route('cards.delete', $card) }}'">Usuń</button>
      @endif
    </td>
  </tr>  
  @endif
  @endforeach
</tbody>
</table>
</div>

<div style="float: right; width: 50%;">
<table class="table table-bordered">
  <thead>
  <th>
    {{$match->team_away->club->name}}
  </th>
  </thead>
  <tbody>
  @foreach ($match->cards as $card)
  @if ($card->player->team->id == $match->team_away->id)
  <tr>
    <td>
      @if ($card->card == 'Żółta')
      <img src="/images/yellowcard.png" width="12px">&nbsp;
      @else
      <img src="/images/redcard.png" width="12px">&nbsp;
      @endif
      {{$card->player->firstname}} {{$card->player->lastname}}&nbsp;
      {{$card->time}}'
      @if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
      <button style="float: right;" class="btn btn-danger btn-xs" onclick="location.href='{{ route('cards.delete', $card) }}'">Usuń</button>
      @endif
    </td>
  </tr>  
  @endif
  @endforeach
</tbody>
</table>
</div>

@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))

<button style="float: left; clear: both;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal_home">Dodaj kartkę dla gospodarzy</button>
<button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal_away">Dodaj kartkę dla gości</button>

@endif
@endif

<!-- Modal -->
  <div class="modal fade" id="myModal_home" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dodaj kartkę dla gospodarzy</h4>
        </div>
        <div class="modal-body">
            <form action="{{route('cards.save')}}" class="form-group" method="post" enctype="multipart/form-data">
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
            <label for="crd">Kartka:</label>
              <select class="form-control" name="card" id="crd" required="required">
                  <option value="Żółta">Żółta</option>
                  <option value="Czerwona">Czerwona</option>
              </select>
          </div>
          <div class="form-group" class="col-sm-3">
            <label for="min">Minuta:</label>
            <input class="form-control" type="number" name="time" min="1" max="150" id="min">
          </div>
            <button type="submit" class="btn btn-success">Dodaj kartkę</button>
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
          <h4 class="modal-title">Dodaj kartkę dla gości</h4>
        </div>
        <div class="modal-body">
            <form action="{{route('cards.save')}}" class="form-group" method="post" enctype="multipart/form-data">
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
            <label for="crd">Kartka:</label>
              <select class="form-control" name="card" id="crd">
                  <option value="Żółta">Żółta</option>
                  <option value="Czerwona">Czerwona</option>
              </select>
          </div>
          <div class="form-group" class="col-sm-3">
            <label for="min">Minuta:</label>
            <input class="form-control" type="number" name="time" min="1" max="150" id="min">
          </div>
            <button type="submit" class="btn btn-success">Dodaj kartkę</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        </div>
      </div>
      
    </div>
  </div>



@endsection