@extends('layouts.app')

@section('content')
<h1>Użytkownicy</span></h1>


<table class="table table-hover">
	<tr>
		<th>Lp.</th>
		<th>Nazwa</th>
		<th>Rola</th>
		<th></th>
		<th></th>
	</tr>
	@foreach($users as $user)
	<tr>
		<td>{{$loop->iteration}}</td>
		<td width="35%">{{$user->name}}</td>
		<td>{{$user->role}}</td>
		<td>
			@if ($user->id != Auth::user()->id)
			<form class="form-inline" action="{{route('users.set_role')}}" method="post">
				<input name="_token" type="hidden" value="{{csrf_token()}}">
				<input type="hidden" name="user_id" value="{{$user->id}}">
				<select name="role" class="form-control">
					<option value="{{$user->role}}" selected="selected">{{$user->role}}</option>
					<option value="Administrator">Administrator</option>
					<option value="Moderator">Moderator</option>
					<option value="Użytkownik">Użytkownik</option>
				</select>
				<button type="submit" class="btn btn-primary">Zaktualizuj</button>
			</form>
			@endif
		</td>
		<td>
			@if ($user->id != Auth::user()->id)
			<button class="btn btn-danger" onclick="location.href='{{ route('users.delete', $user) }}'">Usuń</button>
			@endif
		</td>
	</tr>
	@endforeach
</table>

@endsection