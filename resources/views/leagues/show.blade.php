@extends('layouts.app')

@section('content')

<h1>{{$league->name}}</h1>

Sezony:
<table class="table table-hover">
	@foreach($seasons as $season)
	<tr>
		<td><a href="{{route('seasons.show', $season)}}">{{$season->name}}</a>
    @if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
        <button style="float: right;" class="btn btn-danger" onclick="location.href='{{ route('seasons.delete', $season) }}'">Usuń</button>
    @endif
    </td>
	</tr>
	@endforeach
</table>

@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Dodaj sezon</button>
@endif

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dodaj sezon</h4>
        </div>
        <div class="modal-body">
          	<form action="{{route('seasons.save')}}" method="post" class="form-inline">
				<input name="_token" type="hidden" value="{{csrf_token()}}">
				<input type="hidden" name="league" value="{{$league->id}}">
				<div class="form-group">
					<input type="text" name="name" placeholder="Podaj sezon (np. 2017/2018)" class="form-control" required="required">
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