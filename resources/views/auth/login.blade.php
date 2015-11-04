@extends('layouts.master')
@section('content')
	<h1>Login</h1>
    {!! Form::open(['url'=>'auth/login']) !!}
    	<div class="field-container">
    	{!! Form::label('username','Username:') !!}
    	{!! Form::text('username') !!}
    	</div>

    	<div class="field-container">
    	{!! Form::label('password','Password:') !!}
        {!! Form::password('password') !!}
        </div>

        {!! Form::submit() !!}
    	{{ $errors->first('username') }}
    {!! Form::close() !!}
@stop