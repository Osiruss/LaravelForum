@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
	<a href="{{ url('/') }}">Index</a> >>
	<span>{{ $forum->title }}</span>
</div>
{!! $threads->render() !!}
<a class="btn create" href="{{ url('thread/'.$forum->id.'/create') }}">Create thread</a>
	<table class="forum">
		<thead>
			<tr>
				<th class="forum-title">Forum</th>
				<th class="forum-stats">Author</th>
				<th class="forum-latest">Latest</th>
			</tr>
		</thead>
		<tbody>
			@foreach($threads as $thread)
				<tr>
					<td class='forum-title'>
						<a href="{{ url('thread/'.$thread->id) }}">{{ $thread->title }}</a>
					</td>
					<td class='forum-stats'>
						by <a href="{{ url('user/'.$thread->user_id) }}">{{ $thread->username }}</a><br>
						{{ $thread->post_count }}
						@if(!$thread->post_count || $thread->post_count > 1)
						 replies
						@else 
						 reply
						@endif
					</td>
					<td class='forum-latest'>
						@if($thread->latest->created_at->diffInDays()>7)
							{{ $thread->latest->created_at->format('jS M Y') }}<br>
						@else
							{{ $thread->latest->created_at->diffForHumans() }}<br>
						@endif
						by <a href="{{ url('user/'.$thread->latest->user_id) }}">{{ $thread->latest->username }}</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
{!! $threads->render() !!}
@stop