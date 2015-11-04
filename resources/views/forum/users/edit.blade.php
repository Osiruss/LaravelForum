@extends('layouts.master')
@section('content')
	{!! Form::model($profile, ['files' => true,'url'=>'user/'.$user->id,'method'=>'put']) !!}

		<div class="field-container">
			{!! Form::label('avatar') !!}
			{!! Form::file('avatar') !!}
			{!! $errors->first('avatar','<p class="error">:message</p>') !!}
		</div>

		<div class="field-container">
			{!! Form::label('bio') !!}
			{!! Form::textarea('bio') !!}
			{!! $errors->first('bio','<p class="error">:message</p>') !!}
		</div>

		{!! Form::submit() !!}

	{!! Form::close() !!}
@stop