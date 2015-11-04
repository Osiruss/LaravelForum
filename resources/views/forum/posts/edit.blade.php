@extends('layouts.master')
@section('content')
	{!! Form::model($post, ['url'=>'post/'.$post->id, 'method'=>'PUT']) !!}

	@include('forum.posts._form',['form_label'=>'Content:'])

	{!! Form::close() !!}
@stop