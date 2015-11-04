@extends('layouts.master')
@section('content')

	<table class="forum">
		<thead>
			<tr>
				<th class="forum-title">Forum</th>
				<th class="forum-stats">Stats</th>
				<th class="forum-latest">Latest</th>
			</tr>
		</thead>
		<tbody>
			@foreach($forum_groups as $group)
				<tr>
					<th colspan="100%">
						{{ $group->title }}
					</th>
				</tr>
				@foreach($group->forums as $forum)
					<tr>
						<td class="forum-title">
							<a href="{{ url('forum/'.$forum->id) }}">
								<strong>{{ $forum->title }}</strong><br>
								<em>{{ $forum->description }}</em>
							</a>
						</td>
						<td class="forum-stats">
							{{ $forum->post_count }}
							@if(!$forum->post_count || $forum->post_count > 1)
								 replies
							@else
								 reply
							@endif
							<br>
							{{ $forum->thread_count }}
							@if(!$forum->thread_count || $forum->thread_count > 1)
								 threads
							@else
								 thread
							@endif
						</td>
						<td class="forum-latest">
							@if($forum->latest == null)
								None
							@else
								@if($forum->latest->created_at->diffInDays() > 7)
									{{ $forum->latest->created_at->format('jS M Y') }}<br>
								@else
									{{ $forum->latest->created_at->diffForHumans() }}<br>
								@endif
								by <a href="{{ url('user/'.$forum->latest->user_id) }}">{{ $forum->latest->username }}</a><br>
							@endif
						</td>
					</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>

@stop