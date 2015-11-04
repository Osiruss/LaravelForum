<div class="field-container">
	{!! Form::label('post',$form_label) !!}
	{!! Form::textarea('post') !!}
	{!! $errors->first('post','<p class="error">:message</p>') !!}
</div>
{!! Form::hidden('thread_id',$thread->id) !!}

{!! Form::submit() !!}