@extends('layouts.app')

@section('content')



<h3>Dodaj mecz</h3>
	
	<form action="{{route('matches.save')}}" method="post" enctype="multipart/form-data">
		<input name="_token" type="hidden" value="{{csrf_token()}}">
		<input name="season_id" type="hidden" value="{{$season->id}}">
		<div class="form-group row">
			<label for="r" class="col-sm-1 col-form-label">Nr kolejki:</label>
			<div class="col-sm-1">
				<input class="form-control" type="number" min="1" name="round" id="r" required="required">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3">
				<select class="form-control" name="home" required="required">
					@foreach ($season->teams as $team)
			  			<option value="{{$team->id}}">{{$team->club->name}}</option>
			  		@endforeach
			  	</select>
			</div>
			<div class="col-sm-3">
				<select class="form-control" name="away" required="required">
					@foreach ($season->teams as $team)
			  			<option value="{{$team->id}}">{{$team->club->name}}</option>
			  		@endforeach
			  	</select>
			</div>
			
			<div class="col-sm-2">
				<input class="form-control" type="date" name="date" required="required">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-4">
				<button class="btn btn-primary" class="form-control">Zapisz</button>
			</div>
		</div>
		</div>
	
	</form>

<!-- 	<div class="col-sm-1">
				<input class="form-control" type="number" min="0" name="home_score">
			</div>
			<div class="col-sm-1">
				<input class="form-control" type="number" min="0" name="away_score">
			</div> -->

@endsection