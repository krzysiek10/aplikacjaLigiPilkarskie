@extends('layouts.app')
@section('content')

<h1>{{$season->league->name}}    <span style="font-size: 22px;">sezon: {{$season->name}}</span></h1>

<div style="padding-bottom: 10px;">
	<ul class="nav nav-tabs nav-justified">
    <li><a href="{{ route('teams.index', $season) }}">Drużyny</a></li>
    <li><a href="{{ route('matches.index', $season) }}">Terminarz i wyniki</a></li>
    <li class="active"><a href="{{ route('tables.show', $season) }}">Tabela</a></li>
  </ul>
</div>	

<table class="table">
	<tr>
		<th>Lp.</th>
		<th>Drużyna</th>
		<th>M</th>
		<th>Z</th>
		<th>R</th>
		<th>P</th>
		<th>B+</th>
		<th>B-</th>
		<th>PKT</th>
	</tr>
	@foreach ($tables as $table)
	<tr>
		<td>{{$i+1}}</td>
		<td><img src="/images/logos/{{$table->team->club->logo}}" width="20px"> &nbsp;&nbsp;{{$table->team->club->name}}</td>
		<td>{{$table->matches}}</td>
		<td>{{$table->wins}}</td>
		<td>{{$table->draws}}</td>
		<td>{{$table->loses}}</td>
		<td>{{$table->scored_goals}}</td>
		<td>{{$table->lost_goals}}</td>
		<td>{{$table->points}}</td>
		<?php $i=$i+1; ?>
	</tr>
	@endforeach
</table>

@endsection