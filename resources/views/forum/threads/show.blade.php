@extends('layouts.master')
@section('content')
<div class="breadcrumbs">
	<a href="{{ url('/') }}">Index</a> >>
	<a href="{{ url('forum/'.$forum->id) }}">{{ $forum->title }}</a> >>
	<span>{{ $thread->title }}</span>
</div>
<h1>{{ $thread->title }}</h1>
{!! $posts->render() !!}
<a href="{{ url('post/'.$thread->id.'/create') }}" class="create btn">Create post</a>
<table class="thread">
	<tbody>
		@foreach($posts as $post)
			<tr class="post">
				<td class="post-user">
					<a href="{{ url('user/'.$post->user->id) }}">{{ $post->user->username }}</a><br>
					<img src='{{ $faker->imageUrl(125,125) }}'><br>
					Posts: {{ $post->user->post_count }}<br>
					Joined:{{ $post->user->created_at->format('jS F Y') }}
				</td>
				<td class="post-content">
					<table>
						<tbody>
							<tr>
								<td class="post-permalink">
									<a href="{{ url('post/'.$post->id) }}">
									@if($post->updated_at!=$post->created_at)
										Last updated {{ $post->updated_at->diffForHumans() }}
									@else 
										Posted on {{ $post->created_at->format('jS F Y') }}
									@endif
									</a>
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
				@if(Auth::hasPerm($post->user->id))
					<a href="{{ url('post/'.$post->id.'/edit') }}" class="btn">Edit post</a>
				@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
{!! $posts->render() !!}

	{!! Form::open(['url'=>'post']) !!}

	@include('forum.posts._form',['form_label'=>'Quick reply:'])

	{!! Form::close() !!}
@stop