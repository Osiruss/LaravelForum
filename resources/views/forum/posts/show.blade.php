@extends('layouts.master')
@section('content')
<a href="{{ url('thread/'.$post->thread_id) }}">
	<h1>{{ $post->title }}</h1>
</a>
<table class="thread">
	<tbody>
		<tr class="post">
			<td class="post-user">
				{{ $post->username }}<br>
				<img src='{{ $faker->imageUrl(125,125) }}'><br>
				{{ $post->user_join }}
			</td>
			<td class="post-content">
				<table>
					<tbody>
						<tr>
							<td class="post-permalink">
								<a href="{{ url('post/'.$post->id) }}">{{ $post->updated_at->format('jS F Y') }}</a>
							</td>
						</tr>
						<tr>
							<td class="post-message">
								{!! nl2br($post->post) !!}
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr class="post-edit">
			<td colspan='100%'>
			@if(Auth::hasPerm($post->user_id))
				<a href="{{ url('post/'.$post->id.'/edit') }}" class="btn">Edit post</a>
			@endif
			</td>
		</tr>
	</tbody>
</table>
@stop