@extends('layouts.master')
@section('content')
	{!! Form::open(['url'=>'thread']) !!}
		<div class="field-container">
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
			{!! $errors->first('title','<p class="error">:message</p>') !!}
		</div>

		<div class="field-container">
			{!! Form::label('post', 'Content:') !!}
			{!! Form::textarea('post') !!}
			{!! $errors->first('post','<p class="error">:message</p>') !!}
		</div>

		{!! Form::hidden('forum_id',$forum_id) !!}
		{!! $errors->first('forum_id','<p class="error">:message</p>') !!}

		{!! Form::submit('Create thread') !!}
	{!! Form::close() !!}
@stop