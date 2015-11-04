@extends('layouts.master')
@section('content')
	<h1>Users</h1>
	<table class="userlist">
		<thead>
			<tr>
				<th>
					ID
				</th>
				<th>
					Username
				</th>
				<th>
					Joined
				</th>

			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>
						
					</td>
					<td>
						
					</td>
					<td>
						
					</td>
					<td>
						<a href="{{ url('user/'.$user->id) }}">Profile</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop