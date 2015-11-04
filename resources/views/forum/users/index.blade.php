@extends('layouts.master')
@section('content')
	<h1>Members</h1>
	{!! $users->render() !!}
	<table class="userlist">
		<thead>
			<tr>
				<th>
					<a href="{{ url('members',['hi'=>'no']) }}">ID</a>
				</th>
				<th>
					<a href="{{ url('members',['hi'=>'no']) }}">Username</a>
				</th>
				<th>
					<a href="{{ url('members',['hi'=>'no']) }}">Posts</a>
				</th>
				<th>
					<a href="{{ url('members',['hi'=>'no']) }}">Joined</a>
				</th>

			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>
						{{ $user->id }}
					</td>
					<td>
						{{ $user->username }}
					</td>
					<td>
						{{ $user->post_count }}
					</td>
					<td>
						{{ $user->created_at->format('jS F Y') }}
					</td>
					<td>
						<a href="{{ url('user/'.$user->id) }}">Profile</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
{!! $users->render() !!}
@stop