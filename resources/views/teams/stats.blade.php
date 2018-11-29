@extends('layouts.app')
@section('content')

<h1>{{$team->season->league->name}}    <span style="font-size: 22px;">sezon: {{$team->season->name}}</span></h1>
<h3><img src="/images/logos/{{$team->club->logo}}" width="60px"> {{$team->club->name}}</h3>

<div style="padding-bottom: 10px;">
  <ul class="nav nav-tabs nav-justified">
    <li><a href="{{ route('players.index', $team) }}">Zawodnicy</a></li>
    <li class="active"><a href="{{ route('teams.stats', $team) }}">Statystyki</a></li>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" style="text-align: center;">Mecze</th>
      <th scope="col" style="text-align: center;">Wygrane</th>
      <th scope="col" style="text-align: center;">Remisy</th>
      <th scope="col" style="text-align: center;">Porażki</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="text-align: center;">{{$team->table->matches}}</td>
      <td style="text-align: center;">{{$team->table->wins}}</td>
      <td style="text-align: center;">{{$team->table->draws}}</td>
      <td style="text-align: center;">{{$team->table->loses}}</td>
    </tr>
    </tr>
  </tbody>
</table>

@if ($team->table->matches != 0)

<div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" style='width:{{$wins}}%'>
    Wygrane ({{$wins}}%)
  </div>
  <div class="progress-bar progress-bar-warning" style="width:{{$draws}}%">
    Remisy ({{$draws}}%)
  </div>
  <div class="progress-bar progress-bar-danger" style="width:{{$loses}}%">
    Porażki ({{$loses}}%)
  </div>
</div>

@endif

@endsection