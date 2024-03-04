@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{{ Form::model($load_limit, array('route' => array('load_limits.update', $load_limit->id), 'method' => 'PUT')) }}

		<div class="mb-3">
			{{ Form::label('meter_id', 'Meter_id', ['class'=>'form-label']) }}
			{{ Form::text('meter_id', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('channel', 'Channel', ['class'=>'form-label']) }}
			{{ Form::text('channel', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('load_limit', 'Load_limit', ['class'=>'form-label']) }}
			{{ Form::text('load_limit', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}
@stop
