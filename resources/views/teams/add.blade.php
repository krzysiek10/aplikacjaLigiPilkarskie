@extends('layouts.app')

@section('content')
<h1>{{$season->league->name}}    <span style="font-size: 22px;">sezon: {{$season->name}}</span></h1>

<div style="padding-bottom: 40px;">
	<ul class="nav nav-tabs nav-justified">
    <li class="active"><a href="{{ route('teams.index', $season) }}">Drużyny</a></li>
    <li><a href="{{ route('matches.index', $season) }}">Terminarz i wyniki</a></li>
    <li><a href="{{ route('tables.show', $season) }}">Tabela</a></li>
  </ul>
</div>	

<form action="{{route('teams.save')}}" method="post" enctype="multipart/form-data" class="form-group">
	<input name="_token" type="hidden" value="{{csrf_token()}}">
	<input name="season_id" type="hidden" value="{{$season->id}}">
	<div class="form-group">
			<label for="sel1">Wybierz klub:</label>
			<select class="form-control" name="club_id" id="sel1" required="required">
				@foreach ($clubs as $club)
		  			<option value="{{$club->id}}">{{$club->name}}</option>
		  		@endforeach
		  	</select>
	</div>
	<p>Jeżeli na liście nie ma klubu, który chcesz dodać  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal">kliknij tutaj</button> i utwórz nowy.</p>
	<div class="form-group">
			<button style="float: right;" class="btn btn-success" class="form-control">Dodaj</button>
	</div>
</form>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dodaj klub</h4>
        </div>
        <div class="modal-body">
          	<form action="{{route('clubs.save')}}" method="post" enctype="multipart/form-data" class="form-group">
					<input name="_token" type="hidden" value="{{csrf_token()}}">
					<input name="season_id" type="hidden" value="{{$season->id}}">
					<div class="form-group">
							<input type="text" name="name" placeholder="Podaj nazwę klubu" class="form-control" required="required">
					</div>
					<div class="form-group">
							<label for="logo1">Wybierz logo:</label>
							<input type="file" name="logo" id="logo1" required="required">
					</div>
					<div class="form-group">
							<button class="btn btn-success" class="form-control">Dodaj</button>
					</div>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        </div>
      </div>
      
    </div>
  </div>

@endsection