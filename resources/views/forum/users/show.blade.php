@extends('layouts.master')
@section('content')
<h1>{{ $user->username }}</h1>
<table class="user">
	<tbody>
		<tr>
			<td class="user-stats">
				<img src="{{ url('img/avatars/'.$profile->avatar) }}" alt=""><br>
				Posts: {{ $post_count }}<br>
				Joined: {{ $user->created_at->format('jS F Y') }}<br>
			</td>
			<td class="user-bio">
			<h1>Bio</h1>
			@if($profile->bio === '')
				{{ $faker->realText(300) }}
			@else
				{!! nl2br($profile->bio) !!}
			@endif
			</td>
		</tr>
		<tr>
			<td colspan="100%">
			@if(Auth::hasPerm($user->id))
				<a href="{{ url('user/'.$user->id.'/edit') }}" class="btn">Edit profile</a>
			@endif
			</td>
		</tr>
	</tbody>
</table>

<h1>Recent posts</h1>
<table class="recent-posts">
	<tbody>
		@foreach($posts as $post)
			<tr>
				<td class="thread-title">
					<a href="{{ url('thread/'.$post->thread_id) }}">{{ $post->title }}</a>
				</td>
				<td class="post-time">
					{{ $post->created_at->diffForHumans() }}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@stop