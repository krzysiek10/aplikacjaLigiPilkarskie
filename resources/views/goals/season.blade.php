@extends('layouts.app')

@section('content')
<h1>{{$season->league->name}}    <span style="font-size: 22px;">sezon: {{$season->name}}</span></h1>

<div style="padding-bottom: 10px;">
	<ul class="nav nav-tabs nav-justified">
    <li><a href="{{ route('teams.index', $season) }}">Drużyny</a></li>
    <li><a href="{{ route('matches.index', $season) }}">Terminarz i wyniki</a></li>
    <li><a href="{{ route('tables.show', $season) }}">Tabela</a></li>
    <li class="active"><a href="{{ route('goals.season', $season) }}">Klasyfikacja strzelców</a></li>
  </ul>
</div>	

<table class="table table-hover">
	<tr>
		<th>Lp.</th>
		<th>Imię i nazwisko</th>
		<th>Ilość bramek</th>
	</tr>
	@foreach($players as $player)
		@if($goal->match->season->id == $season->id)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$goal->player->firstname}} {{$goal->player->lastname}}</td>
				<td></td>
			</tr>
		@endif
	@endforeach
</table>

<form action="{{route('teams.add')}}" method="post">
	<input name="_token" type="hidden" value="{{csrf_token()}}">
	<input type="hidden" name="season_id" value="{{$season->id}}">
	<button class="btn btn-primary" class="form-control">Kliknij, aby dodać drużynę</button>
</form>

@endsection