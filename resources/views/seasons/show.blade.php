@extends('layouts.app')
@section('content')

<h1>{{$season->league->name}}    <span style="font-size: 22px;">sezon: {{$season->name}}</span></h1>

<div style="padding-bottom: 10px;">
	<ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="{{ route('teams.index', $season) }}">Drużyny</a></li>
    <li><a href="{{ route('matches.index', $season) }}">Terminarz i wyniki</a></li>
    <li><a href="{{ route('tables.show', $season) }}">Tabela</a></li>
  </ul>
</div>	

<table class="table table-hover">
	@foreach($season->teams as $team)
	<tr>
		<td width="5%" style="vertical-align: middle;"><img width="40px" src="/images/logos/{{$team->club->logo}}"></td>
		<td style="vertical-align: middle;"><a href="{{route('teams.show', $team)}}">{{$team->club->name}}</a></td>
		@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
		<td width="5%"><button class="btn btn-danger" onclick="location.href='{{ route('teams.delete', $team) }}'">Usuń</button></td>
		@endif
	</tr>
	@endforeach
</table>

@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
<button class="btn btn-success" onclick="location.href='{{ route('teams.add', $season) }}'">Dodaj drużynę</button>
@endif

@endsection