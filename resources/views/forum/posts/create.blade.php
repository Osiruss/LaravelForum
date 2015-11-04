@extends('layouts.master')
@section('content')
<a href="{{ url('thread/'.$thread->id) }}">
	<h1>{{ $thread->title }}</h1>
</a>
	{!! Form::open(['url'=>'post']) !!}

	@include('forum.posts._form', ['form_label'=>'Content:'])

	{!! Form::close() !!}
@stop