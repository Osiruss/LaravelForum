@extends('layouts.master')
@section('content')
	<h1>Register</h1>
    {!! Form::open(['url'=>'auth/register']) !!}

        <div class='field-container'>
    	{!! Form::label('username','Username:') !!}
        {!! Form::text('username') !!}
    	{{ $errors->first('username') }}
        </div>

        <div class='field-container'>
    	{!! Form::label('email','Email:') !!}
        {!! Form::text('email') !!}        
    	{{ $errors->first('email') }}
        </div>

        <div class='field-container'>
    	{!! Form::label('password','Password:') !!}
        {!! Form::password('password') !!}
    	{{ $errors->first('password') }}
        </div>

        <div class='field-container'>
    	{!! Form::label('password_confirmation','Confirm password:') !!}
        {!! Form::password('password_confirmation') !!}        
      	{{ $errors->first('password_confirmation') }}
        </div>
      
        {!! Form::submit() !!}
    {!! Form::close() !!}
@stop