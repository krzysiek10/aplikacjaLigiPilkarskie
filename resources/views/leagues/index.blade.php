@extends('layouts.app')

@section('content')
<h1>Twoje ligi</h1>

<table class="table table-hover">
	@foreach($leagues as $league)
	<tr>
		<td><a href="{{route('leagues.show', $league)}}">{{$league->name}}</a></td>
	</tr>
	@endforeach
</table>

@if (Auth::check() && (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator'))
<button style="float: right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Dodaj ligę</button>
@endif

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dodaj ligę</h4>
        </div>
        <div class="modal-body">
          	<form action="{{route('leagues.save')}}" class="form-inline" method="post">
				<input name="_token" type="hidden" value="{{csrf_token()}}">
				<div class="form-group" class="col-sm-6">
					<input type="text" name="name" placeholder="Podaj nazwę ligi" class="form-control" required="required">
				</div>
				<div class="form-group" class="col-sm-6">
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