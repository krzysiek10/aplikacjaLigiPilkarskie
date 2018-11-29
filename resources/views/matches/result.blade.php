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
    <li class="active"><a href="{{ route('matches.result', [ $season, $match ]) }}">Wynik</a></li>
    <li><a href="{{ route('goals.index', [ $season, $match ]) }}">Strzelcy</a></li>
    <li><a href="{{ route('cards.index', [ $season, $match ]) }}">Kartki</a></li>
  </ul>
</div>  
  
<form action="{{route('matches.save_result')}}" method="post" class="form-inline" enctype="multipart/form-data">
	<input name="_token" type="hidden" value="{{csrf_token()}}">
	<input name="match_id" type="hidden" value="{{$match->id}}">
	<input name="season_id" type="hidden" value="{{$season->id}}">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style="text-align: center;">Nr kolejki</th>
      <th scope="col" style="text-align: center;">Gospodarze</th>
      <th scope="col" style="text-align: center;"></th>
      <th scope="col" style="text-align: center;"></th>
      <th scope="col" style="text-align: center;">Goście</th>
      <th scope="col" style="text-align: center;">Data</th>
    </tr>
  </thead>
<tbody>
<td style="text-align: center;">
	{{$match->round}}
</td>
<td style="text-align: center;">{{$match->team_home->club->name}}</td>
<td width="5%">
  @if ($match->played == true)
	<input type="number" class="form-control" name="goals_home" min="0" id="goals_home" required="required" value="{{$match->goals_team1}}">
  @else
  <input type="number" class="form-control" name="goals_home" min="0" id="goals_home" required="required">
  @endif
</td>
<td width="5%">
  @if ($match->played == true)
	<input type="number" class="form-control" name="goals_away" min="0" id="goals_away" required="required" value="{{$match->goals_team2}}">
  @else
  <input type="number" class="form-control" name="goals_away" min="0" id="goals_away" required="required">
  @endif
</td>
<td style="text-align: center;">{{$match->team_away->club->name}}</td>
<td style="text-align: center;">
	{{$match->date}}
</td>
</tbody>
</table>
<div class="form-inline">
  <label for="fin">Mecz zakończył się:&nbsp;</label>
  <select name="final" class="form-control" id="fin" required="required">
    <option value="W regulaminowym czasie">W regulaminowym czasie</option>
    <option value="Po dogrywce">Po dogrywce</option>
    <option value="Po rzutach karnych">Po rzutach karnych</option>
  </select>
</div>
<button class="btn btn-primary" class="form-control">Zapisz</button>
</form>
@endsection